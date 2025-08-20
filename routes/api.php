<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\ContactsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('departments', DepartmentsController::class);

Route::get('employees/search', [EmployeesController::class, 'search']);
Route::get('/employees/{employee}/addresses', [AddressesController::class, 'index']);
Route::post('/employees/{employee}/addresses', [AddressesController::class, 'store']);
Route::get('/employees/{employee}/contacts', [ContactsController::class, 'index']);
Route::post('/employees/{employee}/contacts', [ContactsController::class, 'store']);
Route::apiResource('employees', EmployeesController::class);

Route::get('/addresses/{address}', [AddressesController::class, 'show']);
Route::put('/addresses/{address}', [AddressesController::class, 'update']);
Route::delete('/addresses/{address}', [AddressesController::class, 'destroy']);

Route::get('/contacts/{contact}', [ContactsController::class, 'show']);
Route::put('/contacts/{contact}', [ContactsController::class, 'update']);
Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy']);
