<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;



Route::post('/lang', function (\Illuminate\Http\Request $request) {
    $lang = $request->input('lang');
    if (in_array($lang, ['en', 'ar'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return Redirect::back();
})->name('switch.lang');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('Attendance', AttendanceController::class);
    Route::resource('students', StudentController::class);
    Route::get('/download-student-file/{fileId}', [StudentController::class, 'downloadStudentFile'])->name('student.downloadFile');
    Route::get('/view-student-file/{fileId}', [StudentController::class, 'viewStudentFile'])->name('student.viewFiles');
    Route::resource('employees', EmployeeController::class);
    Route::resource('parents', ParentController::class);
    
});

require __DIR__.'/auth.php';