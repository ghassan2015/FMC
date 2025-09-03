<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurgicalOperation extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }


    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function statuscd()
    {
        return $this->belongsTo(Constant::class, 'status', 'id');
    }
}
