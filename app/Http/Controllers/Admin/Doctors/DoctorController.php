<?php

namespace App\Http\Controllers\Admin\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctors\DoctorRequest;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    public function index()
    {
                $data['specializations'] = Specialization::query()->active()->get();
        $data['branches'] = Branch::query()->active()->get();

        return view('admin.doctors.index',$data);
    }

    // Fetch branches data for DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Doctor::query()
        ->with('specializations')
            ->when(isset($request->is_active), fn($q) => $q->where('specialization_id', $request->specialization_id))
              ->when(isset($request->is_active), fn($q) => $q->wherehas('admin',function($q)use($request){
                $q->where('is_active', $request->is_active);
            }))

             ->when(isset($request->branch_id), fn($q) => $q->wherehas('branches',function($q)use($request){
                $q->where('branch_id', $request->branch_id);
            }))



            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))->orwhere('mobile', 'like', "%{$search}%")
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('photo', fn($data) => view('admin.doctors.partials.coverImage', compact('data')))
            ->addColumn('is_active', fn($data) => view('admin.doctors.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.doctors.partials.actions', compact('data')))
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function create()
    {
        $data['specializations'] = Specialization::query()->active()->get();
        $data['branches'] = Branch::query()->active()->get();

        return view('admin.doctors.create', $data);
    }


    // Store a new branch
public function store(DoctorRequest $request)
{
    DB::beginTransaction();
    try {
        // رفع الصورة (إذا وُجدت)
        $path = $request->hasFile('avatar')
            ? $request->file('avatar')->store('admin', 'public')
            : null;

        // إنشاء الطبيب
        $doctor = Doctor::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'mobile'           => $request->mobile,
            'license_number'   => $request->license_number,
            'about_us'         => ['ar' => $request->about_us_ar, 'en' => $request->about_us_en],
            'specialization_id'=> $request->specialization_id,
        ]);

        // إنشاء المدير المرتبط
        $admin = Admin::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'mobile'         => $request->mobile,
            'password'       => Hash::make($request->password),
            'photo'          => $path,
            'redirect_route' => 'index',
        ]);

        // ربط الطبيب بالمدير
        $doctor->update([
            'admin_id' => $admin->id,
        ]);

        // ربط الفروع
        if ($request->filled('branch_id')) {
            $doctor->branches()->attach($request->branch_id);
        }

        DB::commit();

        return response()->json([
            'status'  => 201,
            'message' => __('label.successful_process'),
        ]);

    } catch (\Exception $exception) {
        DB::rollBack();

        return response()->json([
            'status'  => 422,
            'message' => __('label.process_fail'),
            'error'   => $exception->getMessage(), // مفيد للتصحيح أثناء التطوير
        ]);
    }
}


    public function edit($id){

        $data['doctor']=Doctor::findorfail($id);
                $data['specializations'] = Specialization::query()->active()->get();
        $data['branches'] = Branch::query()->active()->get();

        return view('admin.doctors.edit', $data);

    }

    // Update an existing branch
   public function update(DoctorRequest $request)
{
    DB::beginTransaction();
    try {
        // جلب الطبيب والمدير المرتبط به
        $doctor = Doctor::with('admin')->findOrFail($request->doctor_id);
        $admin  = $doctor->admin;

        // رفع الصورة (إذا وُجدت صورة جديدة)
        $path = $admin->photo; // الاحتفاظ بالصورة القديمة
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('admin', 'public');
        }

        // تحديث بيانات الطبيب
        $doctor->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'mobile'            => $request->mobile,
            'license_number'    => $request->license_number,
            'about_us'          => ['ar' => $request->about_us_ar, 'en' => $request->about_us_en],
            'specialization_id' => $request->specialization_id,
        ]);

        // تحديث بيانات المدير
        $adminData = [
            'name'   => $request->name,
            'email'  => $request->email,
            'mobile' => $request->mobile,
            'photo'  => $path,
        ];

        // تحديث كلمة المرور فقط إذا أرسلها المستخدم
        if ($request->filled('password')) {
            $adminData['password'] = Hash::make($request->password);
        }
        $admin->update($adminData);

        // تحديث الفروع (sync يستبدل القديمة بالجديدة)
        $doctor->branches()->sync($request->branch_id ?? []);

        DB::commit();

        return response()->json([
            'status'  => 200,
            'message' => __('label.successful_process'),
        ]);

    } catch (\Exception $exception) {
        DB::rollBack();

        return response()->json([
            'status'  => 422,
            'message' => __('label.process_fail'),
            'error'   => $exception->getMessage(), // مفيد أثناء التطوير
        ]);
    }
}


    // Delete a branch
public function delete(Request $request)
{
    DB::beginTransaction();
    try {
        $doctor = Doctor::with('admin')->findOrFail($request->id);

        // حذف الفروع المرتبطة
        $doctor->branches()->detach();

        // حذف المدير المرتبط
        if ($doctor->admin) {
            $doctor->admin->delete();
        }

        // حذف الطبيب
        $doctor->delete();

        DB::commit();

        return response()->json([
            'status'  => 200,
            'message' => __('label.successful_process'),
        ]);

    } catch (\Exception $ex) {
        DB::rollBack();

        return response()->json([
            'status'  => 422,
            'message' => __('label.process_fail'),
            'error'   => $ex->getMessage(), // مفيد للتصحيح أثناء التطوير
        ]);
    }
}


    // Update the status of a branch
    public function updateStatus(Request $request)
    {
        try {
            $doctor = Doctor::query()->findOrFail($request->doctor_id);



            $doctor->admin->update([
                'is_active' => $request->is_active
            ]);



            return response()->json([
                "status" => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $ex) {

            return $ex;
            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }
}
