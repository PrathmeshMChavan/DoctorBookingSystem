<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use App\Http\Resources\UserResource;
use App\Jobs\UploadProfilePhoto;

class ProfileController extends BaseController
{
    public function editProfile()
    {
            $user = Auth::user();

            return view('website.profile',compact('user'));
    }


    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone_number' => 'required|max:15',
                'gender' => 'required|in:male,female,other',
                'about' => 'required',
            ], [
                'name.required' => 'The name is required.',
                'address.required' => 'The address is required.',
                'phone_number.required' => 'The phone number is required.',
                'phone_number.max' => 'The phone number must not exceed 15 characters.',
                'gender.required' => 'The gender is required.',
                'gender.in' => 'Invalid gender. Please choose from "male", "female", or "other".',
                'about' => 'The bio is required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            $user = auth()->user();

            if (!$user) {
                return $this->sendError('User not found.', 'The authenticated user was not found.', 404);
            }

            $user->update([
                'full_name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone_number' => $request->input('phone_number'),
                'gender' => $request->input('gender'),
                'about' => $request->input('about')
            ]);

            return $this->sendResponse([], 'Profile updated successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return $this->sendError('Profile Update Error.', 'An error occurred while updating the profile.', 500);
        }
    }
}
