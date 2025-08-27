<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
        protected $table = 'doctor_schedules';

    // الأعمدة المسموح بالـ Mass Assignment
    protected $fillable = [
        'doctor_id',
        'day',
        'start_time',
        'end_time',
        'branch_id',
        'session_duration',
    ];

    // العلاقة مع Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}
