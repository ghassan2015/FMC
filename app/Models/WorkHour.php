<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
      protected $fillable  = ['date','time_in','time_out'];
}
