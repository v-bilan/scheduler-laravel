<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\WitnessController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('about');
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/scheduler', function () {
    return view('scheduler');
})->name('scheduler');

Route::get('sync', SyncController::class)->name('sync');


Route::resource('role', RoleController::class);
Route::resource('witness', WitnessController::class);
