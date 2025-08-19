<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('departments', DepartmentsController::class);
Route::apiResource('employees', EmployeesController::class);
Route::get('employees/search/{keyword}', [EmployeesController::class, 'search']);
