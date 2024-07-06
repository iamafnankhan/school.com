<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make(123456));
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->user_type == 1) {
                return redirect('/admin/dashboard');
            } elseif ($user->user_type == 2) {
                return redirect('/teacher/dashboard');
            } elseif ($user->user_type == 3) {
                return redirect('/student/dashboard');
            } elseif ($user->user_type == 4) {
                return redirect('/parent/dashboard');
            } else {
                return redirect('/admin/dashboard'); // fallback if user_type is not recognized
            }
        }
        return view('auth.login');
    }





    public function AuthLogin(Request $request)
    {
        $remember = $request->has('remember');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = Auth::user();
            if ($user->user_type == 1) {
                return redirect('/admin/dashboard');
            } elseif ($user->user_type == 2) {
                return redirect('/teacher/dashboard');
            } elseif ($user->user_type == 3) {
                return redirect('/student/dashboard');
            } elseif ($user->user_type == 4) {
                return redirect('/parent/dashboard');
            } else {
                return redirect('/admin/dashboard'); // fallback if user_type is not recognized
            }
        } else {
            return redirect()->back()->with('error', 'Please enter Valid Email and Password.');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
