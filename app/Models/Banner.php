<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    protected $fillable  = ['id', 'title', 'is_active', 'photo', 'description'];

    use HasTranslations;
    public $translatable = ['title', 'description'];

    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.png');
    }
}
