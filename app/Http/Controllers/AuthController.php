<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // SHOW REGISTER PAGE
     function showRegister()
    {
        return view('auth.register');
    }

    // REGISTER USER
     function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('loginpage')
            ->with('success', 'Account created successfully!');
    }

    // SHOW LOGIN PAGE
     function showLogin()
    {
        return view('auth.login');
    }

    // LOGIN USER
     function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            return redirect()->route('admindashboard');
        }
        else{
          return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
        }



    }

    // LOGOUT USER
     function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginpage');
    }
}
