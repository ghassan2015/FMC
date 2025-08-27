<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
        protected $guarded = [];
    use HasTranslations;
    public $translatable = ['name','slug','signs', 'description'];


    public function scopeActive($q){

        return $q->where('is_active',1);
    }


    public function categoryAferSurgicalOperations(){

        return $this->hasMany(CategoryAferSurgicalOperation::class,'category_id');

    }
     public function categoryBeforeSurgicalOperations(){

        return $this->hasMany(CategoryBeforeSurgicalOperation::class,'category_id');

    }
    public function childCategories(){

        return $this->hasMany(Category::class,'parent_category_id','id');
    }

    public  function  parentCategories() {

        return $this->belongsTo(Category::class,'parent_category_id','id');
    }

    public function getPhotoAttribute($value){
        return asset('storage/'.$value);
    }
}
