<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);



Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');

});

Route::get('/dashboard', function () {
    return view('teacher/dashboard');
});


Route::get('/dashboard', function () {
    return view('student/dashboard');
});




Route::get('/dashboard', function () {
    return view('parent/dashboard');
});






Route::get('/admin/list', function () {
    return view('Admin/admin/list');
});






