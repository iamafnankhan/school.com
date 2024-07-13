<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



class AuthController extends Controller
{
    public function login()
    {

        // dd(Hash::make(123456));      

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



    public function forgotpassword(Request $request)
    {
        return view('auth.forgot_password');
    }


    public function PostForgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Check your email to reset your password.");
        } else {
            return redirect()->back()->with('error', "Email not found in the database.");
        }
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data['user']= $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function postReset($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
    
            return redirect('/')->with('success', "Password Reset Successfully");
        } else {
            return redirect()->back()->with('error', "Password and confirm password do not match");
        }
    }
    
    

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
