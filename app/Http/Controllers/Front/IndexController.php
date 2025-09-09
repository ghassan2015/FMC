<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Branch;
use App\Models\CountactUs;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Video;
use App\Models\WorkHour;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data['banners'] = Banner::query()->active()->get();
        $data['doctors'] = Doctor::query()->get();
        $data['articles'] = Article::query()->active()->take(6)->orderby('id', 'desc')->get();

        $data['services'] = Service::query()->active()->get();
        $data['branches'] = Branch::query()->active()->get();
        return view('front.index', $data);
    }

    public function aboutUs(Request $request)
    {
        $data['doctors'] = Doctor::query()->get();

        return view('front.aboutUs', $data);
    }

    public function countactUs()
    {

        $data['workHours'] = WorkHour::all();

        return view('front.contactUs', $data);
    }



    public function video()
    {

        $data['videoes'] = Video::query()->paginate(12);

        return view('front.videoes', $data);
    }

    public function storeCountactUs(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // 2️⃣ حفظ البيانات في قاعدة البيانات (اختياري)
        $contact = CountactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);



        return response()->json([
            'success' => true,
            'message' => __('label.success')
        ]);
    }
}
