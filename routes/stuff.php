<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Stuff\HomeController;

Route::group(['middleware' => 'auth'], function () {
    Route::post('/add-stuff', [HomeController::class, 'addStuff'])->name('stuff.add')->middleware('isDemo');
    Route::get('/stuff-dashboard', [HomeController::class, 'doctorindex'])->name('stuff.dashboard');
    Route::post('/create-appointment', [HomeController::class, 'createAppointment'])->name('stuff.create_appointment')->middleware('isDemo');
    Route::get('/stuff-delete/{id}', [HomeController::class, 'stuffDelete'])->name('stuff.delete')->middleware('isDemo');
});
