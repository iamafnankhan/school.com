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
        if (!empty(Auth::check()))
         {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }


    public function AuthLogin(Request $request)
    {
        $remember = $request->has('remember');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('/dashboard');
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
