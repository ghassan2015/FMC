<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingPagRequest;
use App\Models\Setting;

use Illuminate\Http\Request;
class PageSettingController extends Controller
{
    public function index(Request $request)
    {

        return view('admin.settings.page');

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
}
