<?php

namespace App\Http\Controllers\Admin\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Constant;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{



    public function index()
    {
        $data['users'] = User::query()->get();
        $data['paymentTypes'] = Constant::query()->where('group_name', 'payment_type')->get();
        $data['appointmentStatuses'] = Constant::query()->where('group_name', 'appointment_status')->get();
        $data['branches'] = Branch::query()->get();

        $data['doctors'] = Doctor::query()
            ->when(!auth('admin')->user()->is_super && auth('admin')->user()->branch_id, function ($q) {
                $q->wherehas('branches', function ($q) {
                    $q->where('branch_id', auth('admin')->user()->branch_id);
                });
            })
            ->when(auth('admin')->user()->doctor, function ($q) {
                $q->where('id', auth('admin')->user()->doctor?->id);
            })
            ->get();

        return view('admin.appointments.index', $data);
    }

    public function getIndex(Request $request)
    {


        $query = Appointment::query()

            ->when(!auth('admin')->user()->is_super && auth('admin')->user()->branch_id, function ($q) {
                $q->where('branch_id', auth('admin')->user()->branch_id);
            })

            ->when(auth('admin')->user()->doctor, function ($q) {
                $q->where('doctor_id', auth('admin')->user()->doctor?->id);
            });

        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }


        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }


        if ($request->filled('status_id')) {
            $query->where('appointment_status_cd_id', $request->status_id);
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }


        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }


        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }


        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }


        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query
                    ->wherehas('users', function ($q) use ($search) {

                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%");
                    });
            });
        }



        $carbon = Carbon::now();
        return DataTables::of($query)
            ->addColumn('branches', fn($data) => optional($data->branches)->name)
            ->addColumn('doctor_name', fn($data) => $data->doctors?->name)
            ->addColumn('user_name', fn($data) => $data->doctors?->name)

            ->addColumn('status', fn($data) => $data->appointmentStatus?->value_name)

            ->addColumn('payment_type', fn($data) => $data->paymentType?->value_name)
            ->addColumn('payment_status', fn($data) => $data->is_paid)
            ->addColumn('photo', fn($data) => view('admin.appointments.partials.cover', compact('data'))->render())

            ->addColumn('action', fn($data) => view('admin.appointments.partials.actions', compact('data'))->render())
            ->rawColumns(['action',  'photo'])
            ->with([
                'appointment_count' => (clone $query)->count(), // إجمالي المواعيد
                'appointment_month_count' => (clone $query)
                    ->whereMonth('date', now()->month)
                    ->count(), // مواعيد الشهر الحالي
                'appointment_day_count' => (clone $query)
                    ->whereDate('date', now()->toDateString())
                    ->count(), // مواعيد اليوم
                'appointment_pendding_count' => (clone $query)
                    ->where('appointment_status_cd_id', 0) // أو الحالة التي تمثل "قيد الانتظار"
                    ->count(),
            ])
            ->make(true);
    }
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $user_id = $request->user_id;
            if ($request->user_id == 'new') {


                $user = User::query()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'id_number' => $request->id_number,
                    'password' => Hash::make('123456'),
                ]);
                $user_id = $user->id;
            }

            Appointment::query()->create([
                'user_id' => $user_id,
                'doctor_id' => $request->doctor_id,
                'branch_id' => $request->branch_id,
                'time' => $request->time,
                'date' => $request->date,
                'is_paid' => $request->is_paid,
                'payment_type_id' => $request->payment_type_id,
                'appointment_status_cd_id' => $request->appointment_status_id,
            ]);

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

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            // جلب Appointment موجود
            $appointment = Appointment::findOrFail($request->appointment_id);

            $user_id = $request->user_id;

            // إنشاء مستخدم جديد إذا كان "new"
            if ($request->user_id == 'new') {
                $user = User::query()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'id_number' => $request->id_number,
                    'password' => Hash::make('123456'),
                ]);
                $user_id = $user->id;
            }

            // تحديث بيانات الموعد
            $appointment->update([
                'user_id' => $user_id,
                'doctor_id' => $request->doctor_id,
                'branch_id' => $request->branch_id,
                'time' => $request->time,
                'date' => $request->date,
                'is_paid' => $request->is_paid,
                'payment_type_id' => $request->payment_type_id,
                'appointment_status_cd_id' => $request->appointment_status_id,
            ]);

            DB::commit();

            return response()->json([
                'status' => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'status' => 422,
                'message' => __('label.process_fail'),
                'error' => $exception->getMessage(), // مفيد للتصحيح أثناء التطوير
            ]);
        }
    }


    public function delete(Request $request)
    {
        try {
            Appointment::findOrFail($request->id)->delete();


            return response()->json(['status' => 201, 'message' => __('label.successful_process')]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }

    public function getDoctors(Request $request)
    {
        $branchId = $request->branch_id;

        $doctors = Doctor::query()
            ->whereHas('branches', function ($q) use ($branchId) {
                $q->where('branches.id', $branchId);
            })
            ->select('id', 'name')
            ->get();

        return response()->json($doctors);
    }
}
