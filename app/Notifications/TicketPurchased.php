<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketPurchased extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
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
            ->subject('Ticket Purchased Successfully')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your ticket for event "' . $this->order->ticket->event->title . '" has been purchased successfully.')
            ->line('Quantity: ' . $this->order->quantity)
            ->line('Total: $' . $this->order->total)
            ->action('Download Ticket PDF', url('/storage/' . $this->order->pdf_path))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'ticket_id' => $this->order->ticket_id,
            'quantity' => $this->order->quantity,
            'total' => $this->order->total,
        ];
    }
}
