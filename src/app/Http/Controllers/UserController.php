<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
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
            return redirect()->route('user.tickets.index');
        }

        return back()->with('error', 'Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.');
    }


    public function showRegisterForm()
    {
        return view('frontoffice.auth.register');
    }


    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed',
        ], [
            'email.unique' => 'Este correo ya está registrado. Por favor, inicia sesión o usa otro correo.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);
        

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Auth::guard('user')->login($user);

        return redirect()->route('user.tickets.index')->with('success', '¡Registro exitoso! Bienvenido/a.');
    }


    public function showNotificationsView(Request $request)
    {
        $user= Auth::guard('user')->user();

        $query = DatabaseNotification::where('notifiable_id', $user->id)->where('notifiable_type', get_class($user));
        
        if($request->filled('type'))
        {
            $query->where('data->type', $request->type);
        }
        
        $notifications = $query->get();


        return view('backoffice.user.notifications.viewnotifications', compact('notifications'));
    }

    
    public function dashboard()
    {
        $user = Auth::guard('user') -> user();

        $tickets = $user->tickets;

        return view('frontoffice.dashboard', compact('tickets'));
    }

    public function markAsRead($notificationId)
    {
        $user = Auth::guard('user')->user();
        
        $notification = $user->notifications->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->route('user.notifications');
    }
    

    
    public function logOut()
    {
        Auth::guard('user')->logout();

        return redirect()->route('login');
    }
    
}
