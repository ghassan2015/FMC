<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryAferSurgicalOperation;
use Illuminate\Http\Request;
use App\Models\CategoryBeforeSurgicalOperation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{

    public function index()
    {
        $data['categories'] = Category::query()->get();
        return view('admin.categories.index', $data);
    }


    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Category::query()
            ->with('parentCategories')
            ->when(isset($request->is_active), fn($q) => $q->where('is_active', $request->is_active))
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('name', fn($data) => $data->name)

            ->addColumn('photo', fn($data) => view('admin.categories.partials.cover', compact('data')))
            ->addColumn('is_active', fn($data) => view('admin.categories.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.categories.partials.actions', compact('data')))
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function create()
    {
        $data['categories'] = Category::query()->get();
        return view('admin.categories.create', $data);
    }


    public function store(CategoryRequest $request)
    {

        $photo = $request->avatar->store('categories', 'public');
        $category = Category::query()->create([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'slug' =>  Str::slug($request->name_en),
            'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
            'signs' => ['ar' => $request->signs_ar, 'en' => $request->signs_en],
            'video' => $request->video,
            'disease_type' => ['ar' => $request->disease_type_ar, 'en' => $request->disease_type_en],
            'surgery_therapy' => ['ar' => $request->surgery_therapy_ar, 'en' => $request->surgery_therapy_en],
            'surgery_type' => ['ar' => $request->surgery_type_ar, 'en' => $request->surgery_type_en],
            'preparing_operation' => ['ar' => $request->preparing_operation_ar, 'en' => $request->preparing_operation_en],
            'payment_type' => ['ar' => $request->payment_type_ar, 'en' => $request->payment_type_en],
            'operation_pirce' => ['ar' => $request->operation_pirce_ar, 'en' => $request->operation_pirce_en],
            'reason' => ['ar' => $request->reason_ar, 'en' => $request->reason_en],

            'photo' => $photo,
            'is_active' => $request->is_active ? 1 : 0,
        ]);


// صور قبل العملية
if ($request->filled('before_surgical_photos') && is_array($request->before_surgical_photos)) {
    foreach ($request->before_surgical_photos as $value) {
        if ($value) { // تأكد أن القيمة ليست فارغة
            CategoryBeforeSurgicalOperation::query()->updateOrCreate(
                ['id' => $value],
                ['category_id' => $category->id]
            );
        }
    }
}

// صور بعد العملية
if ($request->filled('after_surgical_photos') && is_array($request->after_surgical_photos)) {
    foreach ($request->after_surgical_photos as $value) {
        if ($value) { // تأكد أن القيمة ليست فارغة
            CategoryAferSurgicalOperation::query()->updateOrCreate(
                ['id' => $value],
                ['category_id' => $category->id]
            );
        }
    }
}

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function edit($id)
    {

        $data['category'] = Category::findorfail($id);
        $data['categories'] = Category::query()->get();
        return view('admin.categories.edit', $data);
    }
    public function update(CategoryRequest $request)
    {


        $category = Category::query()->findOrFail($request->category_id);
        $category->update([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'slug' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
            'signs' => ['ar' => $request->signs_ar, 'en' => $request->signs_en],
            'video' => $request->video,
            'is_active' => $request->is_active?1:0,

            'disease_type' => ['ar' => $request->disease_type_ar, 'en' => $request->disease_type_en],
            'surgery_therapy' => ['ar' => $request->surgery_therapy_ar, 'en' => $request->surgery_therapy_en],
            'surgery_type' => ['ar' => $request->surgery_type_ar, 'en' => $request->surgery_type_en],
            'preparing_operation' => ['ar' => $request->preparing_operation_ar, 'en' => $request->preparing_operation_en],
            'payment_type' => ['ar' => $request->payment_type_ar, 'en' => $request->payment_type_en],
            'operation_pirce' => ['ar' => $request->operation_pirce_ar, 'en' => $request->operation_pirce_en],
            'reason' => ['ar' => $request->reason_ar, 'en' => $request->reason_en],
        ]);


        if ($request->avatar) {
            $photo = $request->avatar->store('categories', 'public');

            $category->update([
                'photo' => $photo,

            ]);
        }
        foreach ($request->before_surgical_photos as $value) {
            CategoryBeforeSurgicalOperation::query()->updateOrCreate([
                'id' => $value,
            ], [
                'category_id' => $category->id,
            ]);
        }

        foreach ($request->after_surgical_photos as $value) {
            CategoryAferSurgicalOperation::query()->updateOrCreate([
                'id' => $value,
            ], [
                'category_id' => $category->id,
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function uploadBeforeSurgical(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240', // 10MB
        ]);

        // حفظ الصورة
        $file = $request->file('file');
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/categories/before'), $fileName);

        // تخزين في DB
        $before = CategoryBeforeSurgicalOperation::create([
            'category_id' => 0,
            'photo' => $fileName,
        ]);

        return response()->json([
            'id' => $before->id,
            'path' => asset('uploads/categories/before/' . $fileName),
            'original_name' => $file->getClientOriginalName()
        ]);
    }

    // حذف صور قبل العملية
    public function deleteBeforeSurgical(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $file = CategoryBeforeSurgicalOperation::findOrFail($request->id);
        $filePath = public_path('uploads/categories/before/' . $file->photo);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $file->delete();

        return response()->json(['status' => 'success']);
    }

    // رفع صور بعد العملية
    public function uploadAfterSurgical(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240',
        ]);

        $file = $request->file('file');
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/categories/after'), $fileName);

        $after = CategoryAferSurgicalOperation::create([
            'category_id' => 0,
            'photo' => $fileName,
        ]);

        return response()->json([
            'id' => $after->id,
            'path' => asset('uploads/categories/after/' . $fileName),
            'original_name' => $file->getClientOriginalName()
        ]);
    }

    // حذف صور بعد العملية
    public function deleteAfterSurgical(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $file = CategoryAferSurgicalOperation::findOrFail($request->id);
        $filePath = public_path('uploads/categories/after/' . $file->photo);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $file->delete();

        return response()->json(['status' => 'success']);
    }

    public function updateStatus(Request $request)
    {
        try {
            $category = Category::query()->findOrFail($request->category_id);
            $category->update([
                'is_active' => $request->is_active
            ]);



            return response()->json([
                "status" => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            Category::query()->where('id', $request->id)->delete();

            // Log the deletion of a branchted a branch');

            return response()->json([
                "status" => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }
}
