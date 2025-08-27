<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryBeforeSurgicalOperation extends Model
{
    protected $fillable  = ['id', 'category_id','photo'];
}
