<?php

namespace App\Http\Controllers\Admin\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Constant;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{



    public function index()
    {
        $data['users'] = User::query()->get();
        $data['branches'] = Branch::query()->get();
        $data['paymentTypes'] = Constant::query()->where('group_name', 'payment_type')->get();
        $data['appointmentStatus'] = Constant::query()->where('group_name', 'appointment')->get();

        return view('admin.appointments.index', $data);
    }

    public function getIndex(Request $request)
    {


        $query = Appointment::query();

        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }



        if ($request->filled('status')) {
            $query->where('status', $request->status);
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



        return DataTables::of($query)
            ->addColumn('branches', fn($data) => optional($data->branches)->name)
            ->addColumn('photo', fn($data) => $data->users?->photo)
            ->addColumn('doctor_name', fn($data) => $data->doctors?->name)
            ->addColumn('payment_type', fn($data) => $data->paymentType?->value_name)
            ->addColumn('payment_status', fn($data) => $data->paymentStatus?->value_name)

            ->addColumn('action', fn($data) => view('admin.appointments.partials.actions', compact('data'))->render())
            ->rawColumns(['action',  'photo'])
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

    public function update(Request $request) {}

    public function delete(Request $request) {}

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
