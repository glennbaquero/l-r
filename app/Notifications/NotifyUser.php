<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Carbon\Carbon;

class NotifyUser extends Notification
{
    use Queueable;

    protected $message;
    protected $subject;
    protected $is_reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $subject, $is_reply = false)
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->is_reply = $is_reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject(config('app.name') . ': '. $this->subject)
                    ->greeting('Hello ' . $notifiable->fullname . ',')
                    ->line($this->message);
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
            'message' => $this->message,
            'title' => $this->subject,
            'subject_id' => $notifiable->id, 
            'sender' => auth()->user()->fullname, 
            'sender_id' => auth()->user()->id, 
            'sender_image' => auth()->user()->full_image_path, 
            'timestamp' => Carbon::now()->format('M d, Y h:i A'),
            'subject_type' => get_class($notifiable),
            'is_reply' => $this->is_reply
        ];
    }
}
