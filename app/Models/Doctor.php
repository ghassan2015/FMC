<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Doctor extends Model
{
    protected $fillable  = ['id', 'name', 'is_active', 'photo', 'mobile', 'email', 'about_us', 'admin_id', 'license_number','specialization_id'];

    use HasTranslations;
    public $translatable = ['about_us'];


    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branches_doctors', 'doctor_id', 'branch_id', 'id');
    }

    public function specializations()
    {
        return $this->belongsTo(Specialization::class,  'specialization_id', 'id');
    }

    public function schedules()
{
    return $this->hasMany(DoctorSchedule::class);
}
}
