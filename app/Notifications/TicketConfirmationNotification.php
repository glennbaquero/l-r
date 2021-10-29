<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Channels\Messages\SmsMessage;


class TicketConfirmationNotification extends Notification
{
    use Queueable;

    private $ticket;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['sms'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->subject(config('app.name') . ': '. 'Ticket Verification')
    //                 ->line('Please verify your ticket in Fronteras.')
    //                 ->action('Check Information', route('ticket.confirmation', [$this->ticket->id, $this->ticket->passenger->fullname, $this->ticket->arrival->name, $this->ticket->departure->name]))
    //                 ->line('Thank you!');
    // }


    /**
     * Get the SMS representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \App\Channels\Messages\SmsMessage
     */
    public function toSms($notifiable)
    {
        $appName = config('app.name');
        $notificationLink = route('ticket.confirmation', [$this->ticket->ticket_number, $this->ticket->passenger->fullname, $this->ticket->arrival->name, $this->ticket->departure->name]);

        $message = <<<EOT
Your ticket is not yet confirmed, please pay below.

{$notificationLink}
EOT;

        return (new SmsMessage)->content($message);
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
            //
        ];
    }
}
