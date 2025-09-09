<?php

namespace App\Http\Controllers\Front\Doctors;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {

        $data['doctors'] = Doctor::query()->paginate(12);
        return view('front.doctors.index', $data);
    }

    public function show($id)
    {

        $data['doctor'] = Doctor::findorfail($id);
        $data['branches']=Branch::query()
        ->whereHas('doctors',function($q)use($id){
            $q->where('doctor_id',$id);
        })
        ->get();
        return view('front.doctors.show', $data);
    }
}
