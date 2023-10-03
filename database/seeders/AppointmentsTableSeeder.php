<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentsTableSeeder extends Seeder
{
    public function run()
    {
        $doctorId = 1;
        $date = '2023-09-30';

        $startTime = Carbon::createFromTime(6, 0); // 6:00 AM
        $endTime = Carbon::createFromTime(22, 0); // 10:00 PM
        $breakStartTime = Carbon::createFromTime(12, 0); // 12:00 PM
        $breakEndTime = Carbon::createFromTime(14, 0); // 2:00 PM

        $timeGap = 30; // 30 minutes time gap

        while ($startTime < $endTime) {
            // Check if the current time is within the break time
            if (!$startTime->between($breakStartTime, $breakEndTime)) {
                // Create an appointment record
                Appointment::create([
                    'doctor_id' => $doctorId,
                    'date' => $date,
                    'time' => $startTime->format('H:i:s'),
                    'status' => 'available',
                    'active' => 1,
                ]);
            }

            // Increment the time by the time gap
            $startTime->addMinutes($timeGap);
        }
    }
}
