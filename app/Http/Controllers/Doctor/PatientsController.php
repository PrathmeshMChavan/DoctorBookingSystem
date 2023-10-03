<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\PatientAppointmentLink;
use Illuminate\Support\Carbon;

class PatientsController extends Controller
{
    public function todaysAppointments()
    {
        $doctorId = auth()->user()->id;
        $today = Carbon::now()->toDateString();

        $slots = Appointment::where('doctor_id', $doctorId)
            ->whereDate('date', $today)
            ->pluck('id')
            ->toArray();

        $appointments = PatientAppointmentLink::with('patient','appointment')
            ->whereIn('appointment_xid', $slots)
            ->get();

        return view('doctor.pages.patients.today', compact('appointments'));
    }

    public function allAppointments()
    {
        $doctorId = auth()->user()->id;

        $slots = Appointment::where('doctor_id', $doctorId)
            ->pluck('id')
            ->toArray();

        $appointments = PatientAppointmentLink::with('patient','appointment')
            ->whereIn('appointment_xid', $slots)
            ->get();

        return view('doctor.pages.patients.all', compact('appointments'));
    }
}

