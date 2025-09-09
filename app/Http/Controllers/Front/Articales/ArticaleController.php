<?php

namespace App\Http\Controllers\Front\Articales;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticaleController extends Controller
{
    public function index(){
        $data['articles']=Article::query()->active()->paginate(12);
        return view('front.articales.index',$data);
    }

    public function show($slug){

        $data['article']=Article::query()->where('slug',$slug)->first()??abort(404);
        return view('front.articales.show',$data);

    }
}
