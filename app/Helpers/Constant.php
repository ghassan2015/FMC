<?php

use App\Models\Setting;
use Carbon\Carbon;

function getUploadsPath($path = "")
{
    return public_path() . "/uploads/" . $path;
}
function getUploadsThumbPath($path = "")
{
    return public_path() . "/uploads/thumbs/" . $path;
}

function statusData()
{
    return [
        0 => ['text' => trans('admin.not_active'), 'class' => 'label-light-danger '],
        1 => ['text' => trans('admin.active'), 'class' => 'label-light-info'],
    ];
}

function complaintForm()
{
    return [
        1 => ['text' => trans('admin.visible'), 'class' => 'label-light-info'],
        0 => ['text' => trans('admin.un_visible'), 'class' => 'label-light-danger'],
    ];
}

function getMaxWords($string, $maxWords = 40)
{
    $words = explode(' ', $string);
    if (count($words) > $maxWords) {
        return implode(' ', array_slice($words, 0, $maxWords)) . '...';
    }
    return $string;
}

function settings($key, $value)
{

    $settings = Setting::query()->where('name', $value)->where('key', $key)->first();

    return $settings;
}

    function formatTime($time)
    {
        $t = Carbon::parse($time);

        // إذا اللغة عربية
        if(app()->getLocale() === 'ar') {
            $ampm = $t->format('A') == 'AM' ? 'صباحًا' : 'مساءً';
            return $t->format('h:i') . ' ' . $ampm;
        }

        // إذا اللغة إنجليزية (AM/PM)
        return $t->format('h:i A');
    }
