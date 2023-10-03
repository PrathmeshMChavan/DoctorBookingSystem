<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Http\Controllers\BaseController;
use App\Models\Appointment;
use App\Models\User;
use App\Models\PatientAppointmentLink;
use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentChangesNotify;

class AppointmentController extends BaseController
{
    public function index()
    {
        $date = now();

        $doctorIds = Appointment::whereDate('date', $date)
            ->where('active', '1')
            ->distinct()
            ->pluck('doctor_id')
            ->toArray();
        $doctors = User::whereIn('id', $doctorIds)->where('role', 'doctor')->where('active', '1')->get();
        return view('website.index', compact('doctors', 'date'));
    }

    public function getAppointmentsByDate(Request $request)
    {
        $date = $request->selectedDate;
        $formattedDate = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');

        $doctorIds = Appointment::whereDate('date', $formattedDate)->where('active', '1')->distinct()->pluck('doctor_id')->toArray();
        $doctors = User::whereIn('id', $doctorIds)->where('role', 'doctor')->where('active', '1')->get();

        return view('website.doctor_table', compact('doctors', 'date'));
    }


    public function getTimeSlotsWithDoctor(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = Carbon::parse($request->input('date'))->toDateString();
        $doctor = User::with('doctorProfile')->find($request->input('doctorId'));

        if (!$doctor || $doctor->role !== 'doctor') {
            return $this->sendError('Doctor not found.', 'The specified doctor does not exist or is not a doctor.', 404);
        }
        $availableTimeSlots = Appointment::where('doctor_id', $request->doctorId)
            ->whereDate('date', $date)
            ->where('status', 'available')
            ->pluck('time', 'id')
            ->toArray();
        return view('website.book_appointment', compact('availableTimeSlots', 'doctor', 'date'));
    }

    public function bookAppointment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'slotId' => 'required',
            ], [
                'slotId.required' => 'The slot ID is required.',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            $user = User::find($request->patientId);
            if (!$user) {
                return $this->sendError('User not found.', 'The authenticated user was not found.', 404);
            }

            $patientId = $user->id;
            $slotId = $request->input('slotId');

            $appointment = Appointment::find($slotId);
            $appointmentDate = $appointment->date;
            $appointmentTime = $appointment->time;
            $isAppointment =  PatientAppointmentLink::where('patient_xid', $patientId)
                ->whereHas('appointment', function ($query) use ($appointmentDate) {
                    $query->whereDate('date', $appointmentDate);
                })
                ->exists();

            if ($isAppointment) {
                return $this->sendError('', 'You have already booked appointment for this date', 401);
            }

            PatientAppointmentLink::create(
                [
                    'patient_xid' => $patientId,
                    'appointment_xid' => $slotId,
                ]
            );

            $appointment->status = "pending";
            $appointment->save();

            Mail::to($user->email)->send(new AppointmentConfirmation($appointmentDate, $appointmentTime));

            return $this->sendResponse([], 'Appointment booked successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Appointment booking error: ' . $e->getMessage());
            return $this->sendError('Appointment Booking Error.', 'An error occurred while booking the appointment.', 500);
        }
    }

    public function listBookedAppointments()
    {
        $user = auth()->user();

        $patientId = $user->id;

        $bookedAppointments = PatientAppointmentLink::where('patient_xid', $patientId)
            ->with('appointment','appointment.doctor')
            ->get();

        return view('website.my_booking', compact('bookedAppointments'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'status' => 'required'
            ], [
                'id.required' => 'The appointment ID is required.',
                'status.required' => 'The appointment status is required.',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            $appointment = PatientAppointmentLink::with('appointment')->where('id',$request->id)->first();
            $appointment->status = $request->status;
            $appointment->save();
            $userEmail = User::where('id',$appointment->patient_xid)->value('email');
            $userMail = "mail_templates.appointment_changes_to_patient";
            $doctorEmail = User::where('id',Appointment::where('id',$appointment->appointment_xid)->value('doctor_id'))->value('email');
            $doctorMail = "mail_templates.appointment_changes_to_doctor";

            Mail::to($userEmail)->send(new AppointmentChangesNotify($appointment,$userMail));
            Mail::to($doctorEmail)->send(new AppointmentChangesNotify($appointment,$doctorMail));
            return $this->sendResponse([], 'Appointment {$request->status} changed successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Appointment Status Change error: ' . $e->getMessage());
            return $this->sendError('Appointment Status Change Error.', 'An error occurred while changing the appointment status.', 500);
        }
    }
}
