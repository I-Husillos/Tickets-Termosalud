<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketClosed extends Notification
{
    use Queueable;

    protected $ticket;
    protected $admin;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ticket $ticket, Admin $admin)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ticket Cerrado: ' . $this->ticket->title)
            ->line('El ticket con el título "' . $this->ticket->title . '" ha sido cerrado por el administrador ' . $this->admin->name . '.')
            ->action('Ver Ticket', url('/user/tickets/' . $this->ticket->id))
            ->line('Gracias por usar nuestra aplicación.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
