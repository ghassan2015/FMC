<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    protected $fillable  = ['id', 'name',  'address','long','is_active','late','photo'];

    use HasTranslations;
    public $translatable = ['name','address'];

    public function scopeActive($q){

        return $q->where('is_active',1);
    }


    public function doctors(){
                return $this->belongsToMany(Doctor::class, 'branches_doctors',  'branch_id','doctor_id', 'id');

    }
        public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.png');
    }
}
