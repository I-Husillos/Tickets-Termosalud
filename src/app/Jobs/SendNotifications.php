<?php

namespace App\Jobs;

use App\Models\Ticket;
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
    protected $admin;

    /**
     * Create a new job instance.
     */
    public function __construct(Ticket $ticket, string $type, $extraData = null)
    {
        $this->ticket = $ticket;
        $this->type = $type;

        if ($type === 'commented') {
            $this->comment = $extraData;
        }

        if ($type === 'status_changed') {
            $this->admin = $extraData;
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch ($this->type) {
            case 'created':
                $this->ticket->user->notify(new TicketCreatedNotification($this->ticket));
                break;
    
            case 'commented':
                $this->ticket->user->notify(new TicketCommented($this->ticket, $this->comment));
                break;

            case 'status_changed':
                $this->ticket->user->notify(new TicketStatusChanged($this->ticket, $this->admin));
                break;

            case 'closed':
                $this->ticket->user->notify(new TicketClosed($this->ticket));
                break;

            default:
                break;
        }
    }
}
