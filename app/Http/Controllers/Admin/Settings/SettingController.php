<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    //

    public  function  index()
    {


        return view('admin.settings.index');
    }


    public function update(SettingRequest $request)
    {

        $generalFields = [
            'name' =>['ar'=>$request->name_ar,'en'=>$request->name_en],
            'description' =>['ar'=>$request->description_ar,'en'=>$request->description_en],

        ];

        // Loop through fields and update or create settings
        foreach ($generalFields as $field => $value) {
            $setting = settings('general', $field);

            if (!$setting) {
                Setting::query()->create([
                    'key' => 'general',
                    'name' => $field,
                    'value' => $value,
                ]);
            } else {

                $setting->update(['value' => $value]);
            }
        }


        $contactFields = [
            'whatsapp' =>['ar'=>$request->whatsapp,'en'=>$request->whatsapp],
            'email' =>['ar'=>$request->email,'en'=>$request->email],
            'location' =>['ar'=>$request->location_ar,'en'=>$request->location_en],
            'facebook'=>['ar'=>$request->facebook,'en'=>$request->facebook],
            'mobile'=>['ar'=>$request->mobile,'en'=>$request->mobile]

        ];

        // dd($contactFields);

  foreach ($contactFields as $field => $value) {
            $setting = settings('contact_us', $field);

            if (!$setting) {
                Setting::query()->create([
                    'key' => 'contact_us',
                    'name' => $field,
                    'value' => $value,
                ]);
            } else {

                $setting->update(['value' => $value]);
            }
        }






        // Handle file uploads
        $fileFields = [
            'logo' => 'logo',
            'cover_logo' => 'cover_logo',
            'icon_logo' => 'icon_logo',
        ];

        foreach ($fileFields as $inputName => $fieldName) {
            if ($request->hasFile($inputName)) {
                $setting = settings('general', $fieldName);

                // Upload new file and delete the old one
                $filePath = $request->file($inputName)->store('settings', 'public');

                if ($setting) {
                    if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $setting->update(
                                     [           'value' => ['ar'=>$filePath,'en'=>$filePath],

]                    );
                } else {
                    Setting::query()->create([
                        'key' => 'general',
                        'name' => ['ar'=>$fieldName,'en'=>$fieldName],
                        'value' => ['ar'=>$filePath,'en'=>$filePath],
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'تم تنفيد العملية بنجاح',
        ]);
    }





}
