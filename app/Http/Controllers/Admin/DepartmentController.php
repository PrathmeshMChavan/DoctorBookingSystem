<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BaseController;
use App\Models\Department;

class DepartmentController extends BaseController
{
    public function index()
    {
        $departments = Department::all(['id','name']);
        return view('admin.pages.department.view', compact('departments'));
    }

    public function create()
    {
        return view('admin.pages.department.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:departments',
            ], [
                'name.required' => 'The Department name is required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            Department::create([
                'name' => $request->name,
            ]);

            return $this->sendResponse([], 'Department added successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Department creating error: ' . $e->getMessage());
            return $this->sendError('Department creating Error.', 'An error occurred while creating the department.', 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:departments',
            ], [
                'name.required' => 'The Department name is required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            $department = Department::findOrFail($request->id);
            $department->name = $request->name;
            $department->save();

            return $this->sendResponse([], 'Department updated successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Department updating error: ' . $e->getMessage());
            return $this->sendError('Department updating Error.', 'An error occurred while updating the department.', 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $department = Department::findOrFail($request->id);
            $department->delete();

            return $this->sendResponse([], 'Department deleted successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Department deleting error: ' . $e->getMessage());
            return $this->sendError('Department deleting Error.', 'An error occurred while deleting the department.', 500);
        }
    }
}
