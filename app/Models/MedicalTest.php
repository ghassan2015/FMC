<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MedicalTest extends Model
{
            protected $fillable  = ['id', 'name'] ;

    use HasTranslations;
    public $translatable = ['name'];

}
