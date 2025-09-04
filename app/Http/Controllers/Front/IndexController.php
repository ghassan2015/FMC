<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Doctor;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $data['banners']=Banner::query()->active()->get();
        $data['doctors']=Doctor::query()->get();

        return view('front.index',$data);
    }
}
