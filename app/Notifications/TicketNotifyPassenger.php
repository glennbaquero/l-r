<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketNotifyPassenger extends Notification
{
    use Queueable;

    protected $message;
    protected $route;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $route)
    {
        $this->message = $message;
        $this->route = $route;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(config('app.name') . ': Ticket Information')
                    ->greeting('Hello ' . $notifiable->fullname . ',')
                    ->line($this->message)
                    ->action('Print Here', $this->route);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            // 'message' => $this->message,
            // 'title' => 'Observation',
            // 'subject_id' => $notifiable->id, 
            // 'subject_type' => get_class($notifiable),
        ];
    }
}
