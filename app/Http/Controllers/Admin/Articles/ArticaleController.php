<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Articles\ArticaleRequest;
use App\Models\Article;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticaleController extends Controller
{

    public function index()
    {
        $data['specializations'] = Specialization::query()->active()->get();
        return view('admin.articales.index',$data);
    }

    // Fetch branches data for DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Article::query()
        ->with('specializations')
            ->when(isset($request->is_active), fn($q) => $q->where('is_active', $request->is_active))
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('title', fn($data) => $data->title)
            ->addColumn('photo', fn($data) => view('admin.articales.partials.cover', compact('data')))
            ->addColumn('is_active', fn($data) => view('admin.articales.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.articales.partials.actions', compact('data')))
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    // Store a new branch
    public function store(ArticaleRequest $request)
    {
        try {

            $path = $request->file('avatar')->store('articales', 'public');

            Article::query()->create([
                'title' => ['ar' => $request->title_en, 'en' => $request->title_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'is_active' => $request->is_active ? 1 : 0,
                'photo' => $path,
                'specialization_id'=>$request->specialization_id,

            ]);



            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    // Update an existing branch
    public function update(ArticaleRequest $request)
    {
        try {
            $banner = Article::query()->where('id', $request->banner_id)->first();
            $banner->update([
                'title' => ['ar' => $request->title_en, 'en' => $request->title_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'is_active' => $request->is_active ? 1 : 0,
                'specialization_id'=>$request->specialization_id,

            ]);


            if ($request->avatar) {


                if ($banner->photo && Storage::disk('public')->exists($banner->photo)) {
                    Storage::disk('public')->delete($banner->photo);
                }
                $path = $request->file('avatar')->store('articales', 'public');
                $banner->update([
                    'photo' => $path
                ]);
            }





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

    // Delete a branch
    public function delete(Request $request)
    {
        try {
            $service = Article::query()->where('id', $request->id)->first();
            $service->delete();

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

    // Update the status of a branch
    public function updateStatus(Request $request)
    {
        try {
            $banner = Article::query()->findOrFail($request->banner_id);
            $banner->update([
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

}
