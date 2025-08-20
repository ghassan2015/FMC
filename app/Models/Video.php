<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Video extends Model
{
      protected $fillable  = ['id', 'title','description','thumbnail', 'is_active', 'url'];

    use HasTranslations;
    public $translatable = ['title','description'];

    public function getThumbnailAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.png');
    }
}
