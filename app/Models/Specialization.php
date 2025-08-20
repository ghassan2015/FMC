<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{
            protected $fillable  = ['id', 'name', 'is_active', 'photo', 'description'];

    use HasTranslations;
    public $translatable = ['name','description'];


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.png');
    }

}
