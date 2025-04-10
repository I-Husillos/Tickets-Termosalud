<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController
{

    /*
    Iniciar sesión en panel separado
    Ver todos los tickets
    Filtrar tickets por estado, prioridad, tipo
    Comentar tickets
    Actualizar tickets (estado, prioridad,...)
    ○​ Transiciones permitidas:
    ○​ nuevo → en curso
    ○​ en curso → pendiente | resuelto
    ○​ pendiente → en curso
    ○​ resuelto → cerrado
        ●​ Asignarse tickets o reasignarlos a otros administradores
        ●​ Cerrar ticket
        ●​ Recibir notificaciones
    ○​ Creación de ticket
    ○​ Ticket asignado recibe un comentario
    */

    public function showLoginForm()
    {
        return view('backoffice.adminform');
    }


    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255',
        ]);

        $credentials = $request->only('email','password');;



        $user = Admin::where('email', $validated['email']) -> first();

        if($user)
        {
            Auth::login();
            return redirect()->route('tickets.show')->with('success', 'Iniciado sesión correctamente');
        } else {
            $validated['password'] = Hash::make($validated['password']);
            $newUser = Admin::create($validated);
            Auth::login($newUser);

            return redirect()->route('tickets.show')->with('success', 'Usuario registrado');
        }

    }


    


    public function dashboard()
    {
        return view('admin.dashboard');
    }
    

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

