<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/scheduler', function () {
    return view('scheduler');
})->name('scheduler');

Route::get('/witnesses', function () {
    return view('witnesses');
})->name('witnesses');

Route::resource('role', RoleController::class);
