<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\OrderController;

Route::resource('students', StudentController::class);
Route::resource('products', ProductController::class);
Route::resource('enrollments', EnrollmentController::class);
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::post('/orders/add-item', [OrderController::class, 'addItem']);
Route::delete('/orders/item/{item}', [OrderController::class, 'destroyItem']);

Route::get('/', function () {
    return view('welcome');
});
