<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('Student.Auth.login');
    }

    public function auth(Request $request)
    {
        //  dd($request->all());
         if (auth('student')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            $auth = auth('student')->user();
            // dd($auth);
            return redirect()->route('project');
        }
        // dd("warning", "wrong credentials");
        return redirect()->back()->with("warning", "Wrong Credentials");
    }

    
    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('login_student');
    }
}
