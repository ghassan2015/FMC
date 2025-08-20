<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\AdminProfileRequest;
use App\Http\Requests\Admin\Profile\ChangePasswordRequest;
use App\Http\Requests\Admin\Profile\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{

    public  function  getProfile(){

        return view('admin.profile.index'); // Load the view for DataTable
    }

    public  function  Profile(ProfileRequest $request){

        $user=auth('admin')->user();
        $user->update([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
        ]);



        if($request->avatar){


            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('avatar')->store('profile','public');
            $user->update([
                'photo'=>$path
            ]);
        }
        return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);


    }

    public  function  changePassword(ChangePasswordRequest $request){

        if (!Hash::check($request->current_password, auth('admin')->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => __('messages.The provided password does not match your current password'),
            ]);
        }

        auth('admin')->user()->update([

        'password'=>    Hash::make($request->new_password),

        ]);
        return response()->json(['success' => true, 'message' => 'change password Profile.']);

    }
}
