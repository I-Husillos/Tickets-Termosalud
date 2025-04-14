<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketStatusChanged extends Notification
{
    use Queueable;

    protected $ticket;
    protected $admin;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket, $admin)
    {
        $this->ticket = $ticket;
        $this->admin = $admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Cambio en el estado de tu ticket')
            ->line('El estado de tu ticket ha sido actualizado por el admin ' . $this->admin->name)
            ->line('Nuevo estado: ' . $this->ticket->status)
            ->action('Ver Ticket', url('/user/tickets/' . $this->ticket->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'status',
            'ticket_id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'message' => 'El estado de tu ticket ha sido actualizado por el admin ' . $this->admin->name,
            'priority' => $this->ticket->priority,
            'status' => $this->ticket->status,
            'updated_by' => $this->admin->name,
        ];
    }
}

