<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketCommented;
use App\Notifications\TicketStatusChanged;
use App\Notifications\TicketClosed;


class SendNotifications implements ShouldQueue
{
    use Queueable;

    protected $ticket;
    protected $type;
    protected $comment;
    protected $actor;
    protected mixed $extraData;

    /**
     * Create a new job instance.
     */
    public function __construct($ticketId, string $type, $extraData = null)
    {
        $this->ticket = $ticketId;
        $this->type = $type;

        if ($type === 'commented' || $type === 'user_commented') {
            $this->comment = $extraData;
        }

        if ($type === 'status_changed') {
            $this->actor = $extraData;
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $ticket = $this->ticket instanceof Ticket ? $this->ticket->load(['user', 'admin']): Ticket::with(['user', 'admin'])->find($this->ticket);

        if (!$ticket) {
            \Log::warning("Ticket no encontrado: {$this->ticket}");
            return;
        }

        switch ($this->type) {
            case 'created':
                $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new TicketCreatedNotification($ticket));
            }
            break;

            case 'commented':
                if ($ticket->user) {
                    $ticket->user->notify(new TicketCommented($ticket, $this->comment));
                }
                break;

            case 'user_commented':
                if ($ticket->admin) {
                    $ticket->admin->notify(new TicketCommented($ticket, $this->extraData));
                } else {
                    $admins = Admin::all(); // o filtra los superadmins
                    foreach ($admins as $admin) {
                        $admin->notify(new TicketCommented($ticket, $this->extraData));
                    }
                }
                break;

            case 'status_changed':
                // Verificar si el usuario está relacionado con el ticket antes de notificar
                if ($ticket->user) {
                    $ticket->user->notify(new TicketStatusChanged($ticket, $this->extraData));
                }
                break;

            case 'closed':
                // Verificar si el usuario está relacionado con el ticket antes de notificar
                if ($ticket->user) {
                    // Verificar si $this->actor no es null
                    if ($this->actor) {
                        $ticket->user->notify(new TicketClosed($ticket, $this->actor));
                    } else {
                        // Si no hay actor, puedes decidir cómo manejarlo.
                        // Puedes loguear un error, asignar un valor por defecto o notificar de otra manera.
                        Log::error('No actor provided for TicketClosed notification');
                    }
                }
                break;

            default:
                \Log::warning("Tipo de notificación desconocido: {$this->type}");
                break;
        }
    }
}

// php artisan queue:work redis