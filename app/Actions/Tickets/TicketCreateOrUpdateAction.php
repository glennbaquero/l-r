<?php

namespace App\Actions\Tickets;

use Illuminate\Support\Facades\DB;

use App\Models\Ticket;
use App\Models\Passenger;
use App\Models\Coupon;

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
	
	public function execute($request, $id = null, $update=false)
	{

		$request['purchase_date'] = now();
		$request['seller_id'] = auth()->user()->id;

		DB::beginTransaction();

			if(!$id) {

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


				$this->ticket = $this->ticket->create($request->except(['passenger', 'action', 'has_voucher']));

				if($request->has_voucher) {
					$coupon = Coupon::where('code', $request->voucher_code);
					$coupon->increment('coupon_used');
					$coupon->decrement('coupon_available');
				}

			} else {
				$this->ticket = Ticket::withTrashed()->findOrFail($id);
				if($update) {
					$this->ticket->update([
						'departure_id' => $request->departure_id,
						'arrival_id' => $request->arrival_id,
						'trip_id' => $request->trip_id,
						'total_sale' => $request->total_sale,
						'payment_method' => $request->payment_method,
						'bus_model_column_id' => $request->seat_id,
					]);

					$this->ticket->passenger->update([
						'trip_id' => $request->trip_id,
						'arrival_city_id' => $request->arrival_id,
						'first_name' => $request->passenger_info['first_name'],
						'last_name' => $request->passenger_info['last_name'],
						'email' => $request->passenger_info['email'],
						'phone_number' => $request->passenger_info['phone_number'],
						'ticket_type_id' => $request->passenger_info['ticket_type_id'],
						'no_of_bags' => $request->passenger_info['no_of_bags'],
						'luggage_no' => $request->passenger_info['luggage_no'],
						'gender' => $request->passenger_info['gender'],
						'with_infant' => $request->passenger_info['with_infant'],
						'infant_firstname' => $request->passenger_info['infant_firstname'],
						'infant_lastname' => $request->passenger_info['infant_lastname'],
						'infant_gender' => $request->passenger_info['infant_gender'],
						'bus_model_column_id' => $request->seat_id,
					]);

				} else {
					$this->ticket->update([
						'is_cancelled' => true
					]);
				}
			}


		DB::commit();


		return $this->ticket;
	}
}