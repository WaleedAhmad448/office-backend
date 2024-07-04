<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PersonController;

use App\Http\Controllers\EmployeeController;

Route::prefix('person')->group(function () {
    Route::get('/',[ PersonController::class, 'getAll']);
    Route::post('/',[ PersonController::class, 'create']);
    Route::delete('/{id}',[ PersonController::class, 'delete']);
    Route::get('/{id}',[ PersonController::class, 'get']);
    Route::put('/{id}',[ PersonController::class, 'update']);
});

Route::get('/employees',[App\Http\Controllers\EmployeeController::class, 'index']);

Route::post('/save',[App\Http\Controllers\EmployeeController::class, 'store']);

Route::put('/update/{id}',[App\Http\Controllers\EmployeeController::class, 'update']);

Route::delete('/delete/{id}',[App\Http\Controllers\EmployeeController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
