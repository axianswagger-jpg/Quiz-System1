<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show register page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register user
    public function register(Request $request)
    {
       $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|max:255|unique:users,email',
    'password' => 'required|confirmed|min:8',
]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // Login user
    public function login(Request $request)
    {
        // add login logic here later
    }
}