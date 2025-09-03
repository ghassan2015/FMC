<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $fillable  = ['user_id', 'doctor_id', 'branch_id', 'time', 'date', 'is_paid', 'payment_type_id', 'appointment_type','appointment_status_cd_id'];


    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function  users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function paymentType(){
        return $this->belongsTo(Constant::class,'payment_type_id','id');
    }

     public function appointmentStatus(){
        return $this->belongsTo(Constant::class,'appointment_status_cd_id','id');
    }


    public function getIsPaidAttribute($value){
        return $value?__('label.paid'):__('label.not_paid');
    }


}
