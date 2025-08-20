<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

function generalResponse($status , $message , $data , $status_code = 200) {
    $data = [
        'status' => $status ,
        'message' => $message ,
        'data' => $data ,
    ];
    return $data;
}
function responseJson($status , $message , $data , $status_code = 200) {
    return response()->json(generalResponse($status , $message , $data , $status_code) , $status_code);
}
 function generate_code(){
    $digits = 6;
    return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
}


function upload($file, $folder = 'files')
{
    $filename = uniqid() . '_' . time();

    if ($file->isFile() && $file->getClientOriginalExtension() === 'pdf') {
        // حفظ PDF مباشرة
        $path = $filename . '.pdf';
        $file->storeAs('public/' . $folder, $path);
    } else {
        // معالجة الصور
        $image = Image::make($file);

        // تصغير الصورة مع الحفاظ على النسبة
        $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // ضغط أولي
        $image->encode('jpg', 75);

        // تقليل إضافي إذا كانت أكبر من 1MB
        if (strlen((string) $image) > 1048576) {
            $image->encode('jpg', 50);
        }

        $path = $filename . '.jpg';

        // تخزين الصورة باستخدام Laravel Storage
Storage::put('public/' . $folder . '/' . $path, (string) $image);
    }

    return $folder . '/' . $path; // يرجع المسار داخل storage/public
}


function get_order_number()
{
    $today = date("Ymd");
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 6));
    $unique = $rand;
    return $unique;
}


function get_users_number()
{
    $today = mt_rand(0, 150);
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 6));
    $unique = $today.$rand;
    return $unique;
}


