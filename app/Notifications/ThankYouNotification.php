<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Channels\Messages\SmsMessage;

class ThankYouNotification extends Notification
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
     * Get the SMS representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \App\Channels\Messages\SmsMessage
     */
    public function toSms($notifiable)
    {
        $appName = config('app.name');
        $notificationLink = route('ticket.status', ['paid', $this->ticket->ticket_number, $this->ticket->passenger->fullname, $this->ticket->arrival->name, $this->ticket->departure->name]);

        $message = <<<EOT
Thank you for paying the ticket, you can check your ticket information in the link below.

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
