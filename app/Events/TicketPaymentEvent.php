<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketPaymentEvent implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	protected $message;
	protected $ticket_id;
	protected $ticket;

	public function __construct($message, $ticket_id, $ticket)
	{
	    $this->message = $message;
	    $this->ticket_id = $ticket_id;
	    $this->ticket = $ticket;
	}

	/**
     * Channel name
     *
     */

	public function broadcastOn()
	{
	    return ['ticketPayment-'.$this->ticket_id];
	}

	/**
     * The event's broadcast name.
     *
     * @return string
     */

	public function broadcastAs()
	{
	    return 'paidEvent';
	}

	/**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'ticket_id' => $this->ticket_id,
            'ticket' => $this->ticket,
            'success' => true,
        ];
    }

}

