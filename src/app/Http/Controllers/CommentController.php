<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Admin;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\TicketCommented;

class CommentController
{
    public function addComment(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $author = Auth::user();

        $ticket->comments()->create([
            'author_id' => Auth::id(),
            'author_type' => Auth::user() instanceof Admin ? Admin::class : User::class,
            'message' => $validated['message'],
        ]);

        if ($author instanceof Admin && $ticket->user) {
            $ticket->user->notify(new TicketCommented($ticket, $author));
        } elseif ($author instanceof User && $ticket->admin) {
            $ticket->admin->notify(new TicketCommented($ticket, $author));
        }

        return redirect()->back()->with('success', 'Comentario agregado correctamente.');
    }

    public function viewComments(Ticket $ticket)
    {
        $comments = $ticket->comments()->with('author')->get();
        return view('backoffice.comments.index', compact('comments', 'ticket'));
    }

    // public function updateState($ticket)
    // {
    //     $ticket->user->notify(new TicketCommentedNotification($ticket, auth()->user()));
    // }



    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comentario eliminado correctamente.');
    }
}
