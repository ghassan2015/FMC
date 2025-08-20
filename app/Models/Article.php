<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    protected $fillable  = ['id', 'title', 'is_active', 'photo', 'description','specialization_id'];

    use HasTranslations;
    public $translatable = ['title', 'description'];


    public function specializations(){
        return $this->belongsTo(Specialization::class,'specialization_id','id');
    }
    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.png');
    }

}
