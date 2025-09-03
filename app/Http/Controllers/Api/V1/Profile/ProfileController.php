<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Profile\ChangeLanguageRequest;
use App\Http\Requests\Api\V1\Profile\ChangePasswordRequest;
use App\Http\Requests\Api\V1\Profile\updateProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function getProfile(){
        // ;
        $response['data']=new UserProfileResource(auth('sanctum')->user());


        return response_api(true,__('label.success'),$response,201);
    }

    public function update(updateProfileRequest $request){

        $user=auth('sanctum')->user();

        $user->update([
            'name' => $request->name,
                'mobile' => $request->mobile,
                'id_nunber'=>$request->id_number,
                'email' => $request->email,
                'gender_cd_id'=>$request->gender_cd_id,
                'birth_date'=>$request->birth_date,
        ]);

        if($request->photo){

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }


            $photo = $request->file('photo')->store('Profile', 'public');
            $user->update([
                'photo'=>$photo,
            ]);
        }
        $response['data']=new UserProfileResource(auth('sanctum')->user());


        return response_api(true,__('label.success'),$response,201);
    }

    public function changeLanguage(ChangeLanguageRequest $request){
        $user=auth('sanctum')->user();

        $user->update([
            'lang'=>$request->lang,
        ]);
        $response['data']=null;
        app()->setLocale($request->lang);

        return response_api(true,__('label.success'),$response,201);

    }

    public function changePassword(ChangePasswordRequest $request){
        $user=auth('sanctum')->user();

        $user->update([
            'password'=>Hash::make($request->new_password),
        ]);
        $response['data']=null;
        return response_api(true,__('label.success'),$response,201);

    }

    public function deleteAccount(Request $request){

        User::query()->where('id',auth('sanctum')->id())->delete();
        $response['data']=null;
        return response_api(true,__('label.success'),$response,201);

    }
}
