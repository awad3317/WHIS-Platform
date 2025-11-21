<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsRegisterController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeRegisterController;

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;


Route::post('/lang', function (\Illuminate\Http\Request $request) {
    $lang = $request->input('lang');
    if (in_array($lang, ['en', 'ar'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return Redirect::back();
})->name('switch.lang');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/student_list', [StudentsRegisterController::class, 'index'])->name('student_list.index');
    Route::get('/student_register', [StudentsRegisterController::class, 'create'])->name('student_register.create');
    Route::get('/employee_register', [EmployeeRegisterController::class, 'create'])->name('employee_register.create');
    Route::get('/employee_list', [EmployeeRegisterController::class, 'index'])->name('employee_list.index');
    Route::get('/Dashboard',[DashboardController::class,'index'])->name('Dashboard.index');
        Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard.index');
        Route::get('/Attendance',[AttendanceController::class,'index'])->name('Attendance.index');

Route::get('/students', [StudentsRegisterController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentsRegisterController::class, 'create'])->name('students.create');
Route::post('/students/store', [StudentsRegisterController::class, 'store'])->name('students.store');


    
});

require __DIR__.'/auth.php';