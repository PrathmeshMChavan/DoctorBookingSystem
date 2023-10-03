<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Models\Department;
use App\Models\DoctorDetailLink;
use App\Models\Specialist;
use App\Models\User;

class DoctorController extends BaseController
{
    public function index()
    {
        $doctors = User::with('doctorProfile.department','doctorProfile.specialist')->where('role', 'doctor')->get();
        $departments = Department::all(['id','name']);
        $specialists = Specialist::all(['id','name']);
        return view('admin.pages.doctor.view', compact('doctors','departments','specialists'));
    }

    public function create()
    {
        $specialists = Specialist::get(['id','name']);
        $departments = Department::get(['id','name']);
        return view('admin.pages.doctor.create', compact('specialists','departments'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'gender' => 'required|in:male,female,other',
                'education' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'specialist' => 'required',
                'department' => 'required',
                'phone_number' => 'required|regex:/^\d{10}$/',
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'about' => 'required|string|max:255',
            ], [
                'full_name.required' => 'The full name is required.',
                'email.required' => 'The email is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'The email address is already in use.',
                'password.required' => 'The password is required.',
                'password.min' => 'The password must be at least 8 characters.',
                'gender.required' => 'The gender is required.',
                'gender.in' => 'Invalid gender. Please choose from "male", "female", or "other".',
                'specialist.required' => 'The specialist is required.',
                'phone_number.required' => 'The phone number is required.',
                'phone_number.regex' => 'Invalid phone number format.',
                'profile_photo.required' => 'The profile photo is required.',
                'profile_photo.image' => 'The profile photo must be an image.',
                'profile_photo.mimes' => 'Invalid image format. Supported formats are jpeg, png, jpg, and gif.',
                'profile_photo.max' => 'The profile photo must not exceed 2MB in size.',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            $user = User::create([
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'address' => $request->address,
                'about' => $request->about,
                'role' => 'doctor',
            ]);

            DoctorDetailLink::create([
                'doctor_id' => $user->id,
                'education' => $request->education,
                'specialist_id' => $request->specialist,
                'department_id' => $request->department,
            ]);

            if ($request->hasFile('profile_photo')) {
                $profilePhoto = $request->file('profile_photo');
                $photoPath = $profilePhoto->store('profile_photos', 'public');

                $user->profile_photo = $photoPath;
                $user->save();
            }

            return $this->sendResponse([], 'User created successfully.', 200);
        } catch (\Exception $e) {
            Log::error('User creation error: ' . $e->getMessage());
            return $this->sendError('User Creation Error.', 'An error occurred while creating the user.', 500);
        }
    }

    public function update(Request $request)
    {
    try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
                'gender' => 'required|in:male,female,other',
                'education' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'specialist' => 'required',
                'department' => 'required',
                'phone_number' => 'required|string',
                'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'about' => 'required|string|max:255',
            ], [
                'full_name.required' => 'The full name is required.',
                'email.required' => 'The email is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'The email address is already in use.',
                'gender.required' => 'The gender is required.',
                'gender.in' => 'Invalid gender. Please choose from "male", "female", or "other".',
                'specialist.required' => 'The specialist is required.',
                'phone_number.required' => 'The phone number is required.',
                'profile_photo.image' => 'The profile photo must be an image.',
                'profile_photo.mimes' => 'Invalid image format. Supported formats are jpeg, png, jpg, and gif.',
                'profile_photo.max' => 'The profile photo must not exceed 2MB in size.',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            $user = User::where('role', 'doctor')->findOrFail($request->id);
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->phone_number = $request->phone_number;
            $user->about = $request->about;
            if($request->password)
            {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $doctorProfile = $user->doctorProfile;
            $doctorProfile->education = $request->education;
            $doctorProfile->specialist_id = $request->specialist;
            $doctorProfile->department_id = $request->department;
            $doctorProfile->save();

            if ($request->hasFile('profile_photo')) {
                $profilePhoto = $request->file('profile_photo');
                $photoPath = $profilePhoto->store('profile_photos', 'public');

                $user->profile_photo = $photoPath;
                $user->save();
            }

            return $this->sendResponse([], 'Doctor profile updated successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Doctor profile update error: ' . $e->getMessage());
            return $this->sendError('Doctor Profile Update Error.', 'An error occurred while updating the doctor profile.', 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = User::where('role', 'doctor')->findOrFail($request->id);
            $user->delete();

            return $this->sendResponse([], 'Doctor profile deleted successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Doctor profile deletion error: ' . $e->getMessage());
            return $this->sendError('Doctor Profile Deletion Error.', 'An error occurred while deleting the doctor profile.', 500);
        }
    }
}
