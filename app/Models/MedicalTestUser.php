<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalTestUser extends Model
{
    protected $fillable  = ['id', 'user_id', 'medical_test_id', 'status', 'photo'];



    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function medicalTest()
    {
        return $this->belongsTo(MedicalTest::class, 'medical_test_id', 'id');
    }

    public function statuscd(){
        return $this->belongsTo(Constant::class, 'status', 'id');
    }

    public function getPhotoAttribute($value)
    {

        if ($value) {
            return asset('storage/' . $value);
        }

        return asset('assets/default.png');
    }

    protected $casts = [
        'created_at' => 'date:Y-m-d', // تحويله إلى تاريخ فقط بصيغة YYYY-MM-DD
    ];
}
