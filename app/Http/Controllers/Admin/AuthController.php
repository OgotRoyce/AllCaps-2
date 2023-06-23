<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('Admin.Auth.login');
    }

    public function authenticated(Request $request)
    {
        if (auth()->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            $auth = auth()->user();
            // Authentication successful
            return redirect()->route('tasks_admin');
        }
        // dd("warning","wrong credentials");
        return redirect()->back()->with("warning", "Wrong Credentials");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login_admin');
    }

}
