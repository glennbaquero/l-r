<?php

namespace App\Actions\Tickets;

use Illuminate\Support\Facades\DB;

use App\Models\Ticket;
use App\Models\Passenger;

class TicketCreateOrUpdateAction 
{
	protected $ticket;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Ticket $ticket)
	{
		$this->ticket = $ticket;
	}

	/**
	 * Handles creating or updating of office
	 */
	
	public function execute($request, $id = null)
	{

		$request['purchase_date'] = now();
		$request['seller_id'] = auth()->user()->id;

		DB::beginTransaction();

			$passenger = Passenger::create([
				'trip_id' => $request->trip_id,
				'bus_model_column_id' => $request->bus_model_column_id,
				'first_name' => $request->passenger['first_name'],
				'last_name' => $request->passenger['last_name'],
				'arrival_city_id' => $request->arrival_id,
				'ticket_type_id' => $request->passenger['ticket_type']['id'],
				'email' => $request->passenger['email'],
				'phone_number' => $request->passenger['phone_number'],
				'gender' => $request->passenger['gender'],
				'with_infant' => $request->passenger['with_infant'],
				'infant_firstname' => $request->passenger['infant_firstname'],
				'infant_lastname' => $request->passenger['infant_lastname'],
				'infant_gender' => $request->passenger['infant_gender'],
				'no_of_bags' => $request->passenger['no_of_bags'],
				'luggage_no' => $request->passenger['luggage_no'],
			]);

			$request['passenger_id'] = $passenger->id;

			if(!$id) {
				$this->ticket = $this->ticket->create($request->except(['passenger', 'action']));
			} else {
				$this->ticket = Ticket::withTrashed()->findOrFail($id);
				$this->ticket->update($request->except(['passenger', 'action']));
			}


			
		DB::commit();


		return $this->ticket;
	}
}