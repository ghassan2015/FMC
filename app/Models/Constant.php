<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Constant extends Model
{

    protected $guarded = [];

    use HasTranslations;
    public $translatable = ['value_name'];


}
