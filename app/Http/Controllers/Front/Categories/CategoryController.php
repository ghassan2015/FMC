<?php

namespace App\Http\Controllers\Front\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
    $data['category']=Category::query()->orderby('id','desc')->first();
    return view('front.categories.index',$data);

    }
}
