<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function loginForm()
    {
        return view('doctor.sign_in');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $user = User::where('email', $credentials['email'])->first();

            if ($user && $user->active == 1 && $user->role == 'doctor' && Auth::attempt($credentials)) {
                return $this->sendResponse([], 'Logged In successfully.', 200);
            } else {
                return $this->sendError('Invalid Credentials', 'Invalid Credentials', 401);
            }
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return $this->sendError('Login Error.', 'An error occurred while logging in the user.', 500);
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return redirect()->route('admin.loginForm');
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            session()->flash('error','Logout Failed! Please try again later.');
            return redirect()->back();
        }
    }
}
