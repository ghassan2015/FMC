<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
        protected $fillable  = ['id','name','permission','is_active'];

        use HasTranslations;
    public $translatable = ['name'];

    protected $casts = [
        'permission' => 'array',
    ];

      public function scopeActive($q){

        return $q->where('is_active',1);
    }
}
