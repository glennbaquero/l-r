<?php

namespace App\Actions\Promotions;

use Illuminate\Support\Facades\DB;

use App\Models\Promotion;
use App\Models\PromotionRouteSpecified;
use App\Models\PromotionPartOfRoute;

class PromotionCreateOrUpdateAction 
{
	protected $promotion;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Promotion $promotion)
	{
		$this->promotion = $promotion;
	}

	/**
	 * Handles creating or updating of Promotion
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->promotion = $this->promotion->create($request->except(['route_id', 'arrival_id', 'departure_id']));
			} else {
				$request['days'] = $request->filter_by == 'Day' ? null : ($request->filter_day === 'None' ? null : '');

				if($request->filter_day === 'All') {
					$request['days'] = json_encode(array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'));
				}

				$this->promotion = Promotion::withTrashed()->findOrFail($id);
				$this->promotion->update($request->except(['route_id', 'arrival_id', 'departure_id']));

				$this->promotion->routeSpecifieds()->forceDelete();
				$this->promotion->partOfRoutes()->forceDelete();
			}

			if($request->apply_to == 'Specific Route') {
				foreach (json_decode($request->route_id) as $route) {
					PromotionRouteSpecified::create([
						'promotion_id' => $this->promotion->id,
						'route_id' => $route
					]);
				}
			}

			if($request->apply_to == 'Part of Route') {
				foreach (json_decode($request->departure_id) as $departure) {
					PromotionPartOfRoute::create([
						'promotion_id' => $this->promotion->id,
						'departure_id' => $departure
					]);
				}

				foreach (json_decode($request->arrival_id) as $arrival) {
					PromotionPartOfRoute::create([
						'promotion_id' => $this->promotion->id,
						'arrival_id' => $arrival
					]);
				}
			}
		DB::commit();

		return $this->promotion;
	}
}