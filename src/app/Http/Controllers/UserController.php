<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    
    public function showLoginForm()
    {
        return view('frontoffice.auth.login');
    }


    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email','password');

        if(Auth::guard('user') -> attempt($credentials))
        {
            return redirect() -> route('users.dashboard');
        }
    }


    public function showRegisterForm()
    {
        return view('frontoffice.auth.register');
    }


    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        Auth::guard('user')->login($user);

        return redirect()->route('users.dashboard');
    }


    
    public function dashboard()
    {
        $user = Auth::guard('user') -> user();

        $tickets = $user->tickets;

        return view('frontoffice.dashboard', compact('tickets'));
    }
    
    public function logOut()
    {
        Auth::guard('user')->logout();

        return redirect()->route('home');
    }
    
}
