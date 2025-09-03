<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingPagRequest;
use App\Models\Setting;
use App\Models\WorkHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageSettingController extends Controller
{
    public function index(Request $request)
    {

        $data['work_hours']=WorkHour::query()->get();
        return view('admin.settings.page',$data);
    }
    public function update(SettingPagRequest $request)
    {

        $pageFields = [
            'about_us' => ['ar' => $request->about_us_ar, 'en' => $request->about_us_en],
            'term_condition' => ['ar' => $request->term_condition_ar, 'en' => $request->term_condition_en],
            'privacy_policy' => ['ar' => $request->privacy_policy_ar, 'en' => $request->privacy_policy_en],

        ];

        // Loop through fields and update or create settings
        foreach ($pageFields as $field => $value) {
            $setting = settings('page', $field);

            if (!$setting) {
                Setting::query()->create([
                    'key' => 'page',
                    'name' => $field,
                    'value' => $value,
                ]);
            } else {

                $setting->update(['value' => $value]);
            }
        }



        return response()->json([
            'success' => true,
            'message' => 'تم تنفيد العملية بنجاح',
        ]);
    }



    public function getWorkHours()
    {
                $data['workHours']=WorkHour::all()->keyBy('date');


        return view('admin.settings.workHours',$data);
    }
    public function WorkHours(Request $request)
    {
        // التحقق من صحة البيانات
        $rules = [];
    $validated = $request->validate([
    'date.*' => 'required|string',
    'time_in.*' => 'nullable|date_format:H:i:s',
    'time_out.*' => 'nullable|date_format:H:i:s',
]);




        // حفظ البيانات لكل يوم
        foreach ($request->date as $day => $date) {

            if ($request->time_in[$day] && $request->time_out[$day]) {
                WorkHour::updateOrCreate(
                    ['date' => $date], // شرط لتحديث نفس التاريخ إن وجد
                    [
                        'time_in' => $request->time_in[$day],
                        'time_out' => $request->time_out[$day],
                    ]
                );
            }
        }

     return response()->json([
            'success' => true,
            'message' => 'تم تنفيد العملية بنجاح',
        ]);

    }
}
