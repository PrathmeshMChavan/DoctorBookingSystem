<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BaseController;
use App\Models\Appointment;
use App\Models\PatientAppointmentLink;

class AppointmentController extends BaseController
{
    public function todaysAppointment()
    {
        $today = Carbon::today();

        $slotIds = Appointment::where('date', $today)->pluck('id')->toArray();

        $appointments = PatientAppointmentLink::with('patient','appointment','appointment.doctor')->whereIn('appointment_xid', $slotIds)->get();

        return view('admin.pages.appointment.todays_appointment', compact('appointments'));
    }

    public function allAppointments()
    {
        $appointments = PatientAppointmentLink::all();

        return view('admin.pages.appointment.all_appointment', compact('appointments'));
    }

    public function status(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'status' => 'required',
            ], [
                'id.required' => 'The id is required.',
                'status.required' => 'The status is required.'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            PatientAppointmentLink::where('id', $request->id)->update([
                'status' => $request->status
            ]);

            return $this->sendResponse([], 'Status updated successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Status update error: ' . $e->getMessage());
            return $this->sendError('Status Update Error.', 'An error occurred while updating the status.', 500);
        }
    }
}
