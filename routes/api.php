<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\TaskWitnessDateController;
use App\Http\Controllers\Api\V1\WitnessController;

Route::prefix('v1')->name('api.')->group(
    function () {
        Route::apiResource('role', RoleController::class)->except(['store', 'update', 'destroy']);
        Route::apiResource('witness', WitnessController::class)->except(['store', 'update', 'destroy']);
        Route::apiResource('task-witness-date', TaskWitnessDateController::class)->except(['store', 'update', 'destroy']);
    }
)->except(['store', 'update', 'destroy']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
