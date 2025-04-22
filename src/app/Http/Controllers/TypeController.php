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
            'name' => 'required|string|max:255',
        ]);
    
        $type = new Type();
        $type->name = $request->name;
        $type->save();
    
        if ($request->filled('ticket_id')) {
            $ticket = Ticket::find($request->ticket_id);
            if ($ticket) {
                $ticket->type = $type->name;
                $ticket->save();
            }
    
            return redirect()->route('admin.view.ticket', $ticket->id)
                ->with('success', 'Tipo personalizado creado y asignado al ticket.');
        }
    
        return redirect()->route('admin.types.index')
            ->with('success', 'Tipo de ticket creado correctamente.');
    }
    

    public function edit($id)
    {
        $type = Type::find($id);

        if (!$type) {
            return redirect()->route('admin.types.index')->with('error', 'Tipo de ticket no encontrado');
        }
        return view('backoffice.types.edit', compact('type'));
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
