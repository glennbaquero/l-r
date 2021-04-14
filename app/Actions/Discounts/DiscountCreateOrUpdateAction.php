<?php

namespace App\Actions\Discounts;

use Illuminate\Support\Facades\DB;

use App\Models\Discount;
use App\Models\DiscountGeneralRoute;

class DiscountCreateOrUpdateAction 
{
	protected $discount;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Discount $discount)
	{
		$this->discount = $discount;
	}

	/**
	 * Handles creating or updating of discount
	 */
	
	public function execute($request, $id = null)
	{

		$request['apply_ticket_type'] = $request->filled('apply_ticket_type');
		$request['apply_multiroute'] = $request->filled('apply_multiroute');
		$request['presales_days'] = $request->filled('presales_days');
		$request['open_ticket_applies'] = $request->filled('open_ticket_applies');
		$request['apply_volume_discount'] = $request->filled('apply_volume_discount');
		$request['presales_day'] = $request->filled('presales_day');

		DB::beginTransaction();
			if(!$id) {
				$this->discount = $this->discount->create($request->except(['route_ids', 'service_ids', 'ticket_type_ids', 'arrival_id', 'departure_id', 'multi_route_ids']));
			} else {
				$request['days'] = $request->filter_by == 'Day' ? null : $request['days'];

				if($request->filter_day === 'All') {
					$request['days'] = json_encode(array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'));
				}

				$this->discount = Discount::withTrashed()->findOrFail($id);
				$this->discount->update($request->except(['route_ids', 'service_ids', 'ticket_type_ids', 'arrival_id', 'departure_id', 'multi_route_ids']));

			}
			
			$this->discount->services()->sync(json_decode($request->service_ids));
			$this->discount->ticketTypes()->sync(json_decode($request->ticket_type_ids));
			$this->discount->routes()->sync(json_decode($request->route_ids));
			$this->discount->multiRoutes()->sync(json_decode($request->multi_route_ids));

			if($request->apply_to == 'General Route' || $request->apply_to == 'Part of Route') {
				foreach (json_decode($request->departure_id) as $departure) {
					DiscountGeneralRoute::create([
						'discount_id' => $this->discount->id,
						'departure_id' => $departure
					]);
				}

				foreach (json_decode($request->arrival_id) as $arrival) {
					DiscountGeneralRoute::create([
						'discount_id' => $this->discount->id,
						'arrival_id' => $arrival
					]);
				}
			}

		DB::commit();

		return $this->discount;
	}
}