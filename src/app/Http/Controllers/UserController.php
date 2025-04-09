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
    

    //registrarse/iniciar sesion *
    //crear ticket *
    //ver ticket suyos
    //ver comentarios suyos
    //añadir comentario
    //recibir notificaciones (Ticket recibe un comentario, Ticket cambia de estado)
    //validar resolucion, si no se valida se pasa de resuelta a pendiente

    public function showRegisterForm()
    {
        return view('users.login');
    }


    public function registered(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255',
        ]);

        $user = User::where('email', $validated['email']) -> first();

        if($user)
        {
            Auth::login();
            return redirect()->route('tickets.show')->with('success', 'Iniciado sesión correctamente');
        } else {
            $validated['password'] = Hash::make($validated['password']);
            $newUser = User::create($validated);
            Auth::login($newUser);

            return redirect()->route('tickets.show')->with('success', 'Usuario registrado');
        }

    }
    
    public function logOut()
    {
        Auth::logout();

        return redirect('/');
    }



    public function addUserTicket(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|in:bug,improvement,request',
            'priority' => 'required|in:low,medium,high,critical',
            'status' => 'required|in:new,in_progress,pending,resolved,closed',
            'user_id' => 'required|integer',
            'admin_id' => 'nullable|integer',
            'resolved_at' => 'nullable|date'
        ]);

        $validated['user_id'] = Auth::id();

        Ticket::create($validated);


        return redirect()->route('tickets.show')->with('success', 'Datos añadidos');
    }
    


    public function showUserTickets($id)
    {
        $userId =  Auth::id();

        $tickets = Ticket::where('user_id', $userId)->get();
        return view('tickets.show', compact('tickets'));
    }



    public function searchTicket(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        return view('tickets.ticket', compact('ticket'));
    }

}
