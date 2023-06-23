<?php

namespace App\Http\Controllers\Adviser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    public function login()
    {
        return view('Adviser.Auth.login');
    }

    public function authenticate(Request $request)
    {
        //  dd($request->all());
        if (auth('adviser')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            $auth = auth('adviser')->user();
            // dd($auth);
            return redirect()->route('application');
        }
        // dd("warning", "wrong credentials");
        return redirect()->back()->with("warning", "Wrong Credentials");
    }


    public function logout()
    {
        
        Auth::guard('adviser')->logout();
        return redirect()->route('login_adviser');
    }
}
