<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get(' forgot-password', [AuthController::class, 'forgotpassword']);
Route::post(' forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'postReset']);







Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');

});

Route::get('teacher/dashboard', function () {
    return view('teacher.dashboard');
});


Route::get('student/dashboard', function () {
    return view('student.dashboard');
});




Route::get('parent/dashboard', function () {
    return view('parent.dashboard');
});


// Route::get('forget-password', function () {
//     return view('auth.forgot_password');
// });







Route::get('/admin/list', function () {
    return view('Admin/admin/list');
});






