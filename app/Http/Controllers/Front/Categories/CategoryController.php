<?php

namespace App\Http\Controllers\Front\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index($slug){
    $data['category']=Category::query()->where('slug',$slug)->orderby('id','desc')->first();
    return view('front.categories.index',$data);

    }
}
