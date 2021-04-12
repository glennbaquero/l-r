<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Promotion extends Model
{
	use HasFactory, QueryLike, SoftDeletes;

	protected $casts = [
        'days' => 'array',
    ];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * Type const
	 */
    const type_amount = 'Amount';
    const type_tickets = 'Tickets';
    const type_route = 'Route';

	/**
	 * Filter const
	 */
    const filter_all = 'All';
    const filter_personalized = 'Personalized';
    const filter_none = 'None';

	/**
	 * Apply To const
	 */
    const apply_all = 'All Routes';
    const apply_specified = 'Specific Route';
    const apply_part = 'Part of Route';
    const apply_grouped = 'Route group';

	/**
	 * Ticket const
	 */
    const ticket_all = 'All';
    const ticket_origin = 'Origin';
    const ticket_return = 'Return';
    const ticket_round = 'Round';

	/**
	 * Promotion hasMany route specified
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function routeSpecifieds()
	{
	    return $this->hasMany(PromotionRouteSpecified::class)->withTrashed();
	}

	/**
	 * Promotion hasMany route specified
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function partOfRoutes()
	{
	    return $this->hasMany(PromotionPartOfRoute::class)->withTrashed();
	}

	/**
	  * getting types 
	  * @return array
	  */
	public static function getType() {
	     return [
	        ['value' => static::type_amount, 'label' => static::type_amount],
	        ['value' => static::type_tickets, 'label' => static::type_tickets],
	        ['value' => static::type_route, 'label' => static::type_route],
	    ];
	}

	/**
	  * getting filter 
	  * @return array
	  */
	public static function getDayFilter() {
	     return [
	        ['id' => static::filter_all, 'value' => static::filter_all, 'label' => static::filter_all],
	        ['id' => static::filter_personalized, 'value' => static::filter_personalized, 'label' => static::filter_personalized],
	        ['id' => static::filter_none, 'value' => static::filter_none, 'label' => static::filter_none],
	    ];
	}

	/**
	  * getting apply to 
	  * @return array
	  */
	public static function getApplyTo() {
	     return [
	        ['id' => static::apply_all, 'value' => static::apply_all, 'label' => static::apply_all],
	        ['id' => static::apply_specified, 'value' => static::apply_specified, 'label' => static::apply_specified],
	        ['id' => static::apply_part, 'value' => static::apply_part, 'label' => static::apply_part],
	        ['id' => static::apply_grouped, 'value' => static::apply_grouped, 'label' => static::apply_grouped],
	    ];
	}

	/**
	  * getting ticket 
	  * @return array
	  */
	public static function getTicket() {
	     return [
	        ['value' => static::ticket_all, 'label' => static::ticket_all],
	        ['value' => static::ticket_origin, 'label' => static::ticket_origin],
	        ['value' => static::ticket_return, 'label' => static::ticket_return],
	        ['value' => static::ticket_round, 'label' => static::ticket_round],
	    ];
	}

	/**
	  * getting days 
	  * @return array
	  */
	public static function getDayList() {
	     return [
	        ['id' => 'Monday', 'value' => 'Monday', 'label' => 'Monday'],
	        ['id' => 'Tuesday', 'value' => 'Tuesday', 'label' => 'Tuesday'],
	        ['id' => 'Wednesday', 'value' => 'Wednesday', 'label' => 'Wednesday'],
	        ['id' => 'Thursday', 'value' => 'Thursday', 'label' => 'Thursday'],
	        ['id' => 'Friday', 'value' => 'Friday', 'label' => 'Friday'],
	        ['id' => 'Saturday', 'value' => 'Saturday', 'label' => 'Saturday'],
	        ['id' => 'Sunday', 'value' => 'Sunday', 'label' => 'Sunday'],
	    ];
	}


	/**
	 * Getting the route name
	 */
	
	public function getRouteName() {
		$routeSpecifieds = $this->routeSpecifieds;

		$response = '';

		foreach ($routeSpecifieds as $key => $specific) {
			$response .= $key > 0 ? ',' : '';
			$response .= $specific->route->name;
		}

		return $response;
	}
}
