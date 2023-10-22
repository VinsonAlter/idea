<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class AuthController extends Controller
{
    public function register() {
        return view('auth.register');
    }

    public function store() {
        $validated = request()->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with('success', 'User registered successfully!');
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate() {
        // dd(request()->all());
        
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        // User::create([
        //     'name' => $validated['name'],
        //     'email' => $validated['email'],
        //     'password' => Hash::make($validated['password'])
        // ]);

        if(auth()->attempt($validated)) {
            // remember session regenerate means clear session after this auth done successfully
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'User logged in successfully');
        }
        
        return redirect()->route('login')->withErrors([
            'email' => 'No matching user found with the email and password'
        ]);
    }

    public function logout() {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('dashboard')->with('success', 'logged out successfully');
    }

}