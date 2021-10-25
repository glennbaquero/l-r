<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Channels\Messages\SmsMessage;

use Carbon\Carbon;

class TicketInformationNotification extends Notification
{
    use Queueable;

    protected $ticket;
    protected $route;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
        $this->route = route('ticket.status', ['paid', $this->ticket->ticket_number, $this->ticket->passenger->fullname, $this->ticket->arrival->name, $this->ticket->departure->name]);
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
    //     $trip_time = $this->ticket->trip_time ? $this->ticket->trip_time->formatted_time : now()->format('h:i A');
    //     $travel_date = Carbon::parse($this->ticket->trip->date)->format('Y-m-d'). ' '. $trip_time;
    //     return (new MailMessage)
    //                 ->subject(config('app.name') . ': Payment Form')
    //                 ->greeting('Hello ' . $notifiable->fullname . ',')
    //                 ->line('Informing your payment via credit card.')
    //                 ->line('Departure :'. $this->ticket->departure->name)
    //                 ->line('Arrival :'. $this->ticket->arrival->name)
    //                 ->line('Travel Date :'. $travel_date)
    //                 ->action('Click Here', $this->route);
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
        $notificationLink = $this->route;
        $trip_time = $this->ticket->trip_time ? $this->ticket->trip_time->formatted_time : now()->format('h:i A');
        $travel_date = Carbon::parse($this->ticket->trip->date)->format('Y-m-d'). ' '. $trip_time;
        
        $message = <<<EOT
Ticket Information :
Informing your ticket details for upcoming travel. Please click the link below
Departure : {$this->ticket->departure->name}
Arrival : {$this->ticket->arrival->name}
Travel Date : {$travel_date}

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
