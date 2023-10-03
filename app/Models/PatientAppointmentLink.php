<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientAppointmentLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_xid',
        'appointment_xid'
    ];

    protected $table = "patient_appointment_link";

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_xid', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class,'patient_xid','id');
    }

}
