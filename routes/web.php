<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/', [AuthController::class,'login']);
Route::post('login', [AuthController::class,'AuthLogin']);
Route::get('logout', [AuthController::class,'logout']);


Route::get('/dashboard', function () {
    return view('Admin/dashboard');
});

Route::get('/admin/list', function () {
    return view('Admin/admin/list');
});
