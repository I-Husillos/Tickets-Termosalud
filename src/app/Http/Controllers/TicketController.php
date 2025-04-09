<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController
{
    
    public function showAll()
    {
        $tickets = Ticket::all();
        return view('tickets.ticket', compact('tickets'));
    }



    public function showEditForm($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }


    public function searchTicket(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        return view('tickets.ticket', compact('ticket'));
    }



    public function showForm()
    {
        return view('tickets.create');
    }


    public function addTicket(Request $request)
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


        Ticket::create($validated);


        return redirect()->route('tickets.show')->with('success', 'Datos añadidos');
    }



    
    public function updated(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:new,in_progress,resolved,closed',
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->update($validated);
        

        return redirect()->route('tickets.show')->with('succes', 'Datos actualizados');
    }





    public function deleted($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket -> delete();

        return redirect()->route('tickets.show')->with('succes', 'Datos eliminados');
    }
}
