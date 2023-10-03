<?php

use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\DashboardController;
use App\Http\Controllers\Patient\AppointmentController;
use App\Models\Appointment;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Doctor\AuthController as DoctorAuthController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\PatientsController;
use App\Http\Controllers\Patient\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [AppointmentController::class, 'index'])->name('index');
Route::post('/appointments', [AppointmentController::class, 'getAppointmentsByDate']);

Route::middleware(['patient'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile',[ProfileController::class,'editProfile'])->name('patient.profile');
    Route::post('/update/profile',[ProfileController::class,'update']);

    Route::post('/book/slot/', [AppointmentController::class, 'getTimeSlotsWithDoctor'])->name('book.slot');
    Route::get('/booked/appointments',[AppointmentController::class,'listBookedAppointments'])->name('booked.slot');
    Route::post('/status/appointment',[AppointmentController::class,'updateStatus'])->name('appointment.status');
});


// Admin
Route::get('/sign-in', [AdminAuth::class, 'loginForm'])->name('admin.loginForm');
Route::post('/sign-in', [AdminAuth::class, 'login'])->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/logout', [AdminAuth::class, 'logout']);
    Route::get('/', [AdminDashboardController::class, 'index']);

    Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
    Route::post('/department/update', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/delete/department', [DepartmentController::class, 'delete'])->name('department.delete');


    Route::get('/doctor/create', [DoctorController::class, 'create'])->name('doctor.create');
    Route::post('/doctor/store', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::post('/doctor/update', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('/delete/doctor', [DoctorController::class, 'delete'])->name('doctor.delete');

    Route::get('/appointment/todays', [AdminAppointmentController::class, 'todaysAppointment'])->name('appointment.today');
    Route::get('/appointment/all', [AdminAppointmentController::class, 'allAppointments'])->name('appointment.all');
});

// Doctor
Route::get('/sign_in', [DoctorAuthController::class, 'loginForm'])->name('doctor.loginForm');
Route::post('/sign_in', [DoctorAuthController::class, 'login'])->name('doctor.login');

Route::group(['prefix' => 'doctor', 'middleware' => ['doctor']], function () {
    Route::get('/logout', [DoctorAuthController::class, 'logout'])->name('doctor.logout');
    Route::get('/', [DoctorDashboardController::class, 'index'])->name('doctor_index');

    Route::get('/appointment/create', [DoctorAppointmentController::class, 'create'])->name('doctor.create.appointment');
    Route::post('/create/appointments', [DoctorAppointmentController::class, 'store'])->name('doctor.store.appointment');
    Route::get('/appointments', [DoctorAppointmentController::class, 'index'])->name('doctor.index.appointment');
    Route::post('/edit/appointments', [DoctorAppointmentController::class, 'edit'])->name('doctor.edit.appointment');
    Route::post('/update/appointments', [DoctorAppointmentController::class, 'update'])->name('doctor.update.appointment');

    Route::get('/patients/today', [PatientsController::class, 'todaysAppointments'])->name('doctor.patient.today');
    Route::get('/patients/all', [PatientsController::class, 'allAppointments'])->name('doctor.patient.all');

    Route::post('/appointment/status',[AppointmentController::class,'updateStatus'])->name('appointment.status');
});
