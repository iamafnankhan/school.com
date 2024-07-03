<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/', [AuthController::class,'login']);
Route::post('login', [AuthController::class,'AuthLogin']);
Route::get('logout', [AuthController::class,'logout']);


Route::get('/admin/list', function () {
    return view('Admin/admin/list');
});



Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', function () {
            return view('Admin/dashboard');
        });
    });

Route::group(['middleware' => 'teacher'],function(){

    Route::get('/dashboard', function () {
        return view('teacher/dashboard');
    });
});

Route::group(['middleware' => 'student'],function(){

    Route::get('/dashboard', function () {
        return view('student/dashboard');
    });
});

Route::group(['middleware' => 'parent'],function(){

    Route::get('/dashboard', function () {
        return view('parent/dashboard');
    });
});


});




