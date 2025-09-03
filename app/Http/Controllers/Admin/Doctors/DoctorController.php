<?php

namespace App\Http\Controllers\Admin\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctors\DoctorRequest;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Constant;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Specialization;
use App\Models\User;
use Carbon\Carbon;
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
        $data['users'] = User::query()->get();
        $data['paymentTypes'] = Constant::query()->where('group_name', 'payment_type')->get();

        return view('admin.doctors.index', $data);
    }

    // Fetch branches data for DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Doctor::query()
            ->with('specializations')
            ->when(isset($request->is_active), fn($q) => $q->where('specialization_id', $request->specialization_id))
            ->when(isset($request->is_active), fn($q) => $q->wherehas('admin', function ($q) use ($request) {
                $q->where('is_active', $request->is_active);
            }))

            ->when(isset($request->branch_id), fn($q) => $q->wherehas('branches', function ($q) use ($request) {
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
                'medical_examination_price' => $request->medical_examination_price,

                'about_us'         => ['ar' => $request->about_us_ar, 'en' => $request->about_us_en],
                'specialization_id' => $request->specialization_id,
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


            foreach ($request->branch_id as $branchId) {
                if (isset($request->schedule[$branchId])) {
                    foreach ($request->schedule[$branchId] as $day => $data) {
                        if ($data['start'] && $data['end'] && $data['session_duration']) {
                            DoctorSchedule::create([
                                'doctor_id' => $doctor->id,
                                'branch_id' => $branchId,
                                'day' => $day,
                                'start_time' => $data['start'],
                                'end_time' => $data['end'],
                                'session_duration' => $data['session_duration'],
                            ]);
                        }
                    }
                }
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


    public function edit($id)
    {

        $data['doctor'] = Doctor::findorfail($id);
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
                'medical_examination_price' => $request->medical_examination_price,
                'about_us'          => [
                    'ar' => $request->about_us_ar,
                    'en' => $request->about_us_en,
                ],
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

            // تحديث الفروع المرتبطة بالدكتور
            $doctor->branches()->sync($request->branch_id ?? []);

            // تحديث مواعيد الدكتور لكل فرع
            foreach ($request->branch_id ?? [] as $branchId) {
                if (!empty($request->schedule[$branchId])) {
                    foreach ($request->schedule[$branchId] as $day => $data) {
                        if (!empty($data['start']) && !empty($data['end']) && !empty($data['session_duration'])) {
                            DoctorSchedule::updateOrCreate(
                                [
                                    'doctor_id' => $doctor->id,
                                    'branch_id' => $branchId,
                                    'day'       => $day,
                                ],
                                [
                                    'start_time'       => $data['start'],
                                    'end_time'         => $data['end'],
                                    'session_duration' => $data['session_duration'],
                                ]
                            );
                        }
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status'  => 200,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
            return response()->json([
                'status'  => 422,
                'message' => __('label.process_fail'),
                'error'   => $exception->getMessage(),
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



    public function getBranches(Request $request)
    {
        $doctor = Doctor::with('branches')->findOrFail($request->doctor_id);
        return response()->json($doctor->branches);
    }

    public function getAvailableDays(Request $request)
    {
        $days = DoctorSchedule::where('doctor_id', $request->doctor_id)
            ->where('branch_id', $request->branch_id)
            ->pluck('day'); // هنا تأكد القيم Sunday, Monday أو أرقام

        return response()->json($days);
    }
    // public function getAvailableTimes(Request $request)
    // {
    //     $date = $request->date;
    //     $day = Carbon::parse($date)->format('l'); // اسم اليوم بالإنجليزي
    //     $now = Carbon::now();

    //     // جلب جدول الطبيب
    //     $schedule = DoctorSchedule::where('doctor_id', $request->doctor_id)
    //         ->where('branch_id', $request->branch_id)
    //         ->where('day', $day)
    //         ->first();

    //     if (!$schedule) {
    //         return response()->json([]);
    //     }

    //     // بناء الفترات الزمنية
    //     $start = new \DateTime($schedule->start_time);
    //     $end   = new \DateTime($schedule->end_time);
    //     $interval = new \DateInterval('PT' . $schedule->session_duration . 'M');

    //     // تعديل النهاية لتضم آخر جلسة
    //     $end->modify('+1 second');
    //     $periods = new \DatePeriod($start, $interval, $end);

    //     // جلب الأوقات المحجوزة وتوحيد التنسيق
    //     $booked = Appointment::where('doctor_id', $request->doctor_id)
    //         ->where('branch_id', $request->branch_id)
    //         ->whereDate('date', $date)
    //         ->pluck('time')
    //         ->map(function($t) {
    //             return Carbon::parse($t)->format('H:i:s');
    //         })
    //         ->toArray();

    //     $bookedTimes = array_flip($booked);

    //     // فلترة الأوقات المتاحة
    //     $available = [];
    //     foreach ($periods as $time) {
    //         $formatted = $time->format('H:i:s');

    //         // تجاهل الأوقات المحجوزة
    //         if (isset($bookedTimes[$formatted])) {
    //             continue;
    //         }

    //         // إذا التاريخ اليومي الحالي، تجاهل الأوقات الماضية
    //         if (Carbon::parse($date)->isToday() && $time < $now) {
    //             continue;
    //         }

    //         $available[] = $formatted;
    //     }

    //     return response()->json($available);
    // }

    public function getAvailableTimes(Request $request)
    {
        $date = $request->date;
        $day = Carbon::parse($date)->format('l');
        $now = Carbon::now();

        $schedule = DoctorSchedule::where('doctor_id', $request->doctor_id)
            ->where('branch_id', $request->branch_id)
            ->where('day', $day)
            ->first();

        if (!$schedule) {
            return response()->json([]);
        }

        $start = new \DateTime($schedule->start_time);
        $end   = new \DateTime($schedule->end_time);
        $interval = new \DateInterval('PT' . $schedule->session_duration . 'M');
        $end->modify('+1 second');
        $periods = new \DatePeriod($start, $interval, $end);

        // جلب الأوقات المحجوزة مع استثناء الموعد الحالي إذا موجود
        $bookedQuery = Appointment::where('doctor_id', $request->doctor_id)
            ->where('branch_id', $request->branch_id)
            ->whereDate('date', $date);

        if ($request->appointment_id) {
            $bookedQuery->where('id', '!=', $request->appointment_id);
        }

        $booked = $bookedQuery->pluck('time')
            ->map(fn($t) => Carbon::parse($t)->format('H:i:s'))
            ->toArray();

        $bookedTimes = array_flip($booked);

        $available = [];
        foreach ($periods as $time) {
            $formatted = $time->format('H:i:s');

            if (isset($bookedTimes[$formatted])) continue;

            if (Carbon::parse($date)->isToday() && $time < $now) continue;

            $available[] = $formatted;
        }

        return response()->json($available);
    }
}
