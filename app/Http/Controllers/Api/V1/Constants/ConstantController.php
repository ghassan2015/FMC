<?php

namespace App\Http\Controllers\Api\V1\Constants;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConstantResource;
use App\Http\Resources\SettingResource;
use App\Models\Constant;
use App\Models\Setting;
use Illuminate\Http\Request;

class ConstantController extends Controller
{
    public function index()
    {
        $constants = Constant::query()->get()->groupBy('group_name');
        $response['data'] = $constants->map(function ($group) {
            return ConstantResource::collection($group);
        });
        return response_api(true, 'تم تنفيد العملية بنجاح', $response, 200);
    }

    public function getSettings()
    {
        $settings = Setting::query()->get();
        $response['data'] = SettingResource::collection($settings);
        return response_api(true, 'تم تنفيد العملية بنجاح', $response, 200);
    }
}
