<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;

use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }
public function postLogin(LoginRequest $request)
{
    try {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();

            $redirectUrl = $admin->redirect_route
                ? route('admin.' . $admin->redirect_route)
                : route('admin.index');

            return response()->json([
                'status' => 'success',
                'message' => 'Welcome back!',
                'redirect' => $redirectUrl
            ]);
        }

        // تسجيل الدخول فشل
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid email or password.'
        ], 401);

    } catch (\Throwable $ex) {
        return response()->json([
            'status' => 'error',
            'message' => $ex->getMessage()
        ], 500);
    }
}

    public function logout()
    {
        $admin = Auth::guard('admin')->user();


        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
