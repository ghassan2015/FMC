<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrugUser extends Model
{
    protected $fillable  = ['name', 'number_time_use','note','user_id'];
}
