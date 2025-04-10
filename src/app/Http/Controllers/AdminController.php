<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController
{

    public function showLoginForm()
    {
        return view('frontoffice.auth.adminform');
    }

    public function dashboard()
    {
        $tickets = Ticket::all();
        return view('backoffice.admin.dashboard', compact('tickets'));
    }


    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $credentials = $request->only('email','password');;



        $user = Admin::where('email', $validated['email']) -> first();

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    
    }



    public function viewTicket(Ticket $tickets)
    {
        return view('backoffice.admin.viewtickets', compact('tickets'));
    }
    

    public function manageTickets()
    {
        $tickets = Ticket::all();
        return view('backoffice.admin.managetickets', compact('tickets'));
    }


    public function manageUsers()
    {
        $users = User::all();
        return view('backoffice.admin.manageusers', compact('users'));
    }


    public function filterTickets(Request $request)
    {
        $query = Ticket::query();

        if($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if($request->filled('priority')){
            $query->where('priority', $request->piority);
        }

        if($request->filled('type')){
            $query->where('type', $request->type);
        }

        $tickets = $query->get();
        return view('backoffice.admin.managetickets', compact('tickets'));
    }


    public function assignTicket(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'admin'=>'required|exist:admins,id'
        ]);


        $ticket->update(['admin_id' => $validated['admin_id']]);

        return redirect() -> route('admin.manage.tickets')->with('success', 'Ticket asignado correctamente.');
    }


    public function updateTicketStatus(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,pending,resolved,closed',
            'priority' => 'nullable|in:low,medium,high,critical',
        ]);

        $ticket->update($validated);

        return redirect() -> route('admin.manage.tickets')->with('success', 'Ticket asignado correctamente.');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

