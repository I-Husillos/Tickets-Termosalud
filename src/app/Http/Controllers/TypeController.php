<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Ticket;

class TypeController
{

    public function index()
    {
        $types = Type::all();
        return view('backoffice.types.index', compact('types'));
    }

    public function create()
    {
        return view('backoffice.types.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Type::create($request->all());
        return redirect()->route('admin.types.index')->with('success', 'Tipo de ticket creado con éxito');
    }
    

    public function edit()
    {
        
    }

    public function updateTicketStatus(Request $request, Ticket $ticket)
    {
        if ($request->type === 'other') {
            return redirect()->route('admin.types.create')->with('ticket_id', $ticket->id);
        }

        $ticket->status = $request->status;
        $ticket->priority = $request->priority;
        $ticket->type = $request->type;
        $ticket->save();

        return redirect()->route('admin.view.ticket', $ticket->id)->with('success', 'Ticket actualizado correctamente');
    }

    
    

    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Tipo de ticket eliminado con éxito');
    }
}
