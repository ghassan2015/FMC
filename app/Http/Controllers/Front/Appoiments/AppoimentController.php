<?php

namespace App\Http\Controllers\Front\Appoiments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppoimentController extends Controller
{
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

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();


            $user = User::query()->updateOrCreate(
                [
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'id_number' => $request->id_number,
                ],
                [
                    'password' => Hash::make('123456'),

                    'name' => $request->name,

                ]
            );


            Appointment::query()->create([
                'user_id' => $user->id,
                'doctor_id' => $request->doctor_id,
                'branch_id' => $request->branch_id,
                'time' => "12:00",
                'date' => $request->date,
                'is_paid' => 0,
                'payment_type_id' => 4,
                'appointment_status_cd_id' => 5,
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
}
