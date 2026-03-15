<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/dashboard-stats', [DashboardController::class, 'index']);
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/students',       [StudentController::class, 'index']);
    Route::post('/students',      [StudentController::class, 'store']);
    Route::get('/students/{id}',  [StudentController::class, 'show']);
    Route::put('/students/{id}',  [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

});