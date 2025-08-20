<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
        protected $fillable  = ['id', 'name', 'is_avtive'];

    use HasTranslations;
    public $translatable = ['name'];

}
