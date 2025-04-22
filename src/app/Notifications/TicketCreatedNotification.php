<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    use Queueable;


    protected $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;   // Pasamos la información del ticket cuando se crea la notificación.
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database']; // Define los canales por los cuales se enviará la notificación (por correo electronico y ara almacenar la notificación en la base de datos)
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nuevo ticket creado.')
            ->line('Un nuevo ticket a sido creado por ' . $this->ticket->user->name)
            ->line('Titulo del ticket: ' . $this->ticket->title)
            ->action('Ver ticket', url('/user/tickets/' . $this->ticket->id));
    }


    public function toDatabase(object $notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'message'     => 'Se ha creado un nuevo ticket.',
            'created_by'  => $this->ticket->user->name,
            'priority'    => $this->ticket->priority,
            'type'        => $this->ticket->type,
            'status'      => $this->ticket->status,
        ];
    }
}

