<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AppointmentController extends BaseController
{
    public function index()
    {
        $doctorId = auth()->user()->id;

        $appointments = Appointment::where('doctor_id', $doctorId)->get();

        $slots = $appointments->unique('date');

        return view('doctor.pages.appointment.check', compact('slots'));
    }

    public function create()
    {
        $now = now();

        $bookedDates = Appointment::where('doctor_id', auth()->user()->id)
            ->where('date', '>', $now)
            ->pluck('date')
            ->unique()
            ->toArray();
        $bookedDatesJson = json_encode($bookedDates);

        return view('doctor.pages.appointment.create', compact('bookedDatesJson'));
    }


    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'date' => [
                    'required',
                    'date',
                    Rule::unique('appointments')->where(function ($query) {
                        return $query->where('doctor_id', auth()->user()->id);
                    }),
                ],
                'time_array' => 'required|array',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            foreach ($request->time_array as $time) {
                Appointment::create([
                    'doctor_id' => auth()->user()->id,
                    'date' => $request->date,
                    'time' => $time,
                ]);
            }

            return $this->sendResponse([], 'Appointment created successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Appointment creating error: ' . $e->getMessage());
            return $this->sendError('Appointment Creating Error.', 'An error occurred while creating the appointment.', 500);
        }
    }

    public function edit(Request $request)
    {
        $date = $request->input('date');
        $doctorId = auth()->user()->id;

        $selectedTimes = Appointment::whereDate('date', $date)
            ->where('doctor_id', $doctorId)
            ->pluck('time')
            ->toArray();

        return view('doctor.pages.appointment.edit', compact('selectedTimes'));
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'date' => [
                    'required',
                    'date'
                ],
                'time_array' => 'required|array',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }

            $date = $request->date;
            $doctorId = auth()->user()->id;

            $existingAppointments = Appointment::whereDate('date', $date)
                ->where('doctor_id', $doctorId)
                ->get();

            $selectedTimes = $request->time_array;

            foreach ($existingAppointments as $appointment) {
                if (!in_array($appointment->time, $selectedTimes)) {
                    $appointment->delete();
                }
            }

            foreach ($selectedTimes as $time) {
                if (!$existingAppointments->contains('time', $time)) {
                    Appointment::create([
                        'doctor_id' => auth()->user()->id,
                        'date' => $date,
                        'time' => $time,
                    ]);
                }
            }

            return $this->sendResponse([], 'Appointments updated successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Appointment updating error: ' . $e->getMessage());
            return $this->sendError('Appointment Updating Error.', 'An error occurred while updating the appointments.', 500);
        }
    }

}
