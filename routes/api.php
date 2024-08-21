<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//   return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('appointment', AppointmentController::class);

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum','is_admin'])->group( function (){
    Route::get('admin/appointments',[AdminController::class, 'index']);
    Route::get('admin/appointments/{id}',[AdminController::class, 'show']);
    Route::put('admin/appointments/{id}',[AdminController::class, 'update']);
    Route::get('admin/appointments/{id}',[AdminController::class, 'destroy']);
});
