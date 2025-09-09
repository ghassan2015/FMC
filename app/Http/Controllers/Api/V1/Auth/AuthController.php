<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\CheckCodeUserRequest;
use App\Http\Requests\Api\V1\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\newPasswordRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\Auth\SocailLoginRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use App\Notifications\ForgotPasswordCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
      public function Register(RegisterRequest $request)
    {

        try {


            $user = User::query()->create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'id_number'=>$request->id_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender_cd_id'=>$request->gender_cd_id,
                'fcm_token'=>$request->fcm_token,
                'birth_date'=>$request->birth_date,

            ]);





            $user->plainTextToken = $user->createToken('user-token')->plainTextToken;

            $response['data'] = new UserProfileResource($user);

            return response_api(true, __('messages.success'), $response, 201);
        } catch (\Exception $exception) {
            $response['data'] = [];
            return $exception;
            return response_api(false, __('lang.error'), $response, 500);
        }
    }
    public function Login(LoginRequest $request)
    {

        try {

            $user = User::where('email', $request->email)->first();


            $user->update([
                'fcm_token' => $request->fcm_token,
            ]);
            $user->plainTextToken = $user->createToken('user-token')->plainTextToken;

            $response['data'] = new UserProfileResource($user);

            return response_api(true, __('lang.success'), $response, 201);
        } catch (\Exception $exception) {
            $response['data'] = [];
            return response_api(false, __('lang.error'), $response, 500);
        }
    }

    public function forgotPassword(ForgetPasswordRequest $request)
    {
        try {


            $user = User::where('email', $request->email)->first();


            $code = mt_rand(1000, 9999); // Generate 4-digit code
            $user->update([
                'code' => $code,
            ]);


            $user->notify(new ForgotPasswordCode($code, $user->name));
            $response['data'] = [
                'code'=>$code,
            ];

            return response_api(true, __('lang.success'), $response, 201);
        } catch (\Exception $exception) {
            return $exception;
            $response['data'] = [];
            return response_api(false, __('lang.error'), $response, 500);
        }
    }

    public function checkCodeVerification(CheckCodeUserRequest $request)
    {

        try {


            $response['data'] = [];
            return response_api(true, __('label.succes'), $response, 201);
        } catch (\Exception $exception) {
            $response['data'] = [];
            return response_api(false, __('messages.error'), $response, 500);
        }
    }




    public function socialLogin(SocailLoginRequest $request)
    {

        $user = User::query()->where('email',$request->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'provider_id' => $request->provider_id,
                'provider_name' => $request->provider_name,
                'fcm_token' => $request->fcm_token,


            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'provider_id' => $request->provider_id,
                'provider_name' => $request->provider_name,
                'fcm_token' => $request->fcm_token,


            ]);
        }


        $user->plainTextToken = $user->createToken('user-token')->plainTextToken;
        $response['data'] = new UserProfileResource($user);
        return response_api(true, __('lang.success'), $response, 200);
    }

    public function newPassword(newPasswordRequest $request)
    {
        try{
        $user = User::where('email', $request->email)->first();

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        $response['data'] = [];

     $response['data'] = [];
            return response_api(true, __('label.success'), $response, 201);
        } catch (\Exception $exception) {
            $response['data'] = [];
            return response_api(false, __('label.error'), $response, 500);
        }

    }
    public function logout(Request $request)
    {
        try {


            $user =   auth('sanctum')->user();


            $user->update([
                'fcm_token' => null
            ]);
            $user = $request->user();

            $user->tokens()->delete();

            $response['data'] = [];
            return response_api(true, __('label.success'), $response, 201);
        } catch (\Exception $exception) {
            $response['data'] = [];
            return response_api(false, __('label.error'), $response, 500);
        }
    }
}
