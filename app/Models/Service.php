<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
        protected $fillable  = ['id', 'name', 'is_active', 'photo', 'description','icon_logo'];

    use HasTranslations;
    public $translatable = ['name','description'];

    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.png');
    }
    public function getIconLogoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.png');
    }

    public function scopeActive($q){
        return $q->where('is_active',1);
    }




}
