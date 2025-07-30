<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SchoolSessionController;
use App\Http\Controllers\ClassModelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;



Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', 'login')->name('login');

Route::post('/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    if ($email === 'admin@gmail.com' && $password === 'admin') {
        session(['user' => 'admin']);
        return redirect('/dashboard');
    }

    return redirect()->back()->withErrors(['Invalid credentials']);
});

Route::get('/dashboard', function () {
    if (!session()->has('user')) {
        return redirect('/login');
    }
    return view('dashboard');
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/login');
})->name('logout');


// for session... this is routes for sessions

Route::resource('sessions', SchoolSessionController::class);

// Optional route to set a session as active
Route::post('/sessions/{id}/activate', [SchoolSessionController::class, 'activate'])->name('sessions.activate');


// this is for class and section modules 

Route::resource('classes', ClassModelController::class);
Route::resource('sections', SectionController::class);
Route::post('/classes/store-section', [ClassModelController::class, 'storeSection'])->name('classes.storeSection');


Route::resource('students', StudentController::class);

// routes/web.php
Route::resource('teachers', TeacherController::class);


//for subjectcontroller
Route::resource('subjects', SubjectController::class);
