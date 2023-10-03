<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\DoctorFactory;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->count(10) // Adjust the number of doctors you want to create
            ->create();
    }
}
