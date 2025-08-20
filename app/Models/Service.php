<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
        protected $fillable  = ['id', 'name', 'is_active', 'photo', 'description'];

    use HasTranslations;
    public $translatable = ['name','description'];

    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.png');
    }
}
