<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\WitnessController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('about');
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/scheduler', function () {
    return view('scheduler');
})->name('scheduler');

Route::resource('role', RoleController::class);
Route::resource('witness', WitnessController::class);
