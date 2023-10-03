<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    public function index()
    {
        return view('website.login');
    }

    public function registerForm()
    {
        return view('website.register');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $user = User::where('email', $credentials['email'])->first();

            if ($user && $user->active == 1 && Auth::attempt($credentials)) {
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
            return redirect()->route('index');
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            session()->flash('error','Logout Failed! Please try again later.');
            return redirect()->back();
        }
    }

    public function register(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'gender' => 'required|in:male,female,other',
                'c_password' => 'required|same:password',
            ], [
                'full_name.required' => 'The full name is required.',
                'email.required' => 'The email is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'The email address is already in use.',
                'password.required' => 'The password is required.',
                'password.min' => 'The password must be at least 8 characters.',
                'gender.required' => 'The gender is required.',
                'gender.in' => 'Invalid gender. Please choose from "male", "female", or "other".',
                'c_password.required' => 'The confirmation password is required.',
                'c_password.same' => 'The confirmation password must match the password field.',
            ]);


            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'role' => 'patient'
            ]);

            return $this->sendResponse([], 'User registered successfully.', 201);
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return $this->sendError('Registration Error.', 'An error occurred while registering the user.', 500);
        }
    }
}
