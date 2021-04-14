<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Discount extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


	/**
	 * Trip Type const
	 */
    const trip_type_all = 'All';
    const trip_type_one_way = 'One Way';
    const trip_type_roundtrip = 'Roundtrip';

	/**
	 * discount type const
	 */
    const discount_type_percentage = 'Percentage';
    const discount_type_amount = 'Amount';
    const discount_type_fixed = 'Fixed';

	/**
	 * change type const
	 */
    const change_type_discount = 'Discount';
    const change_type_increase = 'Increase';
    const change_type_plane_fare = 'Plane Fare';

	/**
	 * Filter Day Range const
	 */
    const filter_day_range_all = 'All';
    const filter_day_range_personalized = 'Personalized';

	/**
	 * Apply To const
	 */
    const apply_all = 'All Routes';
    const apply_specified = 'Specific Route';
    const apply_part = 'Part of Route';
    const apply_general = 'General Route';

    /**
     * Promotion Apply To const
     */
    const promotion_apply_system = 'System';
    const promotion_apply_web = 'Web';
    const promotion_apply_all = 'All';
    const promotion_apply_none = 'None';

    /**
     * Discount belongs to many services
     * 
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * Discount belongs to many ticket types
     * 
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function ticketTypes()
    {
        return $this->belongsToMany(TicketType::class);
    }

    /**
     * Coupon belongs to many routes
     * 
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function routes()
    {
        return $this->belongsToMany(Route::class);
    }

    /**
     * Coupon belongs to many multiroutes
     * 
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function multiRoutes()
    {
        return $this->belongsToMany(MultiRoute::class);
    }

    /**
     * Coupon hasMany general route
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function generalRoutes()
    {
        return $this->hasMany(DiscountGeneralRoute::class)->withTrashed();
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
            ['id' => static::apply_general, 'value' => static::apply_general, 'label' => static::apply_general],
        ];
    }

    /**
      * getting trip type
      * @return array
      */
    public static function getTripType() {
         return [
            ['id' => static::trip_type_all, 'value' => static::trip_type_all, 'label' => static::trip_type_all],
            ['id' => static::trip_type_one_way, 'value' => static::trip_type_one_way, 'label' => static::trip_type_one_way],
            ['id' => static::trip_type_roundtrip, 'value' => static::trip_type_roundtrip, 'label' => static::trip_type_roundtrip],
        ];
    }

	/**
	  * getting discount type
	  * @return array
	  */
	public static function getDiscountType() {
	     return [
	        ['id' => static::discount_type_percentage, 'value' => static::discount_type_percentage, 'label' => static::discount_type_percentage],
	        ['id' => static::discount_type_amount, 'value' => static::discount_type_amount, 'label' => static::discount_type_amount],
	        ['id' => static::discount_type_fixed, 'value' => static::discount_type_fixed, 'label' => static::discount_type_fixed],
	    ];
	}

    /**
      * getting change type
      * @return array
      */
    public static function getChangeType() {
         return [
            ['id' => static::change_type_discount, 'value' => static::change_type_discount, 'label' => static::change_type_discount],
            ['id' => static::change_type_increase, 'value' => static::change_type_increase, 'label' => static::change_type_increase],
            ['id' => static::change_type_plane_fare, 'value' => static::change_type_plane_fare, 'label' => static::change_type_plane_fare],
        ];
    }

	/**
	  * getting filter day range
	  * @return array
	  */
	public static function getFilterDayRange() {
	     return [
	        ['id' => static::filter_day_range_all, 'value' => static::filter_day_range_all, 'label' => static::filter_day_range_all],
	        ['id' => static::filter_day_range_personalized, 'value' => static::filter_day_range_personalized, 'label' => static::filter_day_range_personalized],
	    ];
	}

    /**
      * getting promotion applies to
      * @return array
      */
    public static function getPromotionAppliesTo() {
         return [
            ['id' => static::promotion_apply_system, 'value' => static::promotion_apply_system, 'label' => static::promotion_apply_system],
            ['id' => static::promotion_apply_web, 'value' => static::promotion_apply_web, 'label' => static::promotion_apply_web],
            ['id' => static::promotion_apply_all, 'value' => static::promotion_apply_all, 'label' => static::promotion_apply_all],
            ['id' => static::promotion_apply_none, 'value' => static::promotion_apply_none, 'label' => static::promotion_apply_none],
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
     * Getting the selected days in specific discount
     */

    public function getDays() {
        $text = '';

        if(count(json_decode($this->days)) == 7) {
            return 'Monday to Sunday';
        }

        foreach (json_decode($this->days) as $key => $day) {

            $text .= $key > 0 ? ',' : '';

            switch ($day) {
                case 'Monday':
                    $text .= 'Monday';
                    break;
                case 'Tuesday':
                    $text .= 'Tuesday';
                    break;
                case 'Wednesday':
                    $text .= 'Wednesday';
                    
                    break;
                case 'Thursday':
                    $text .= 'Thursday';
                    
                    break;
                case 'Friday':
                    $text .= 'Friday';
                    
                    break;
                case 'Saturday':
                    $text .= 'Saturday';
                    
                    break;
                case 'Sunday':
                    $text .= 'Sunday';
                    
                    break;
            }
        }

        return $text;
    }

    /**
     * Getting the route name
     */
    
    public function getRouteName() {
        $routeSpecifieds = $this->routes;

        $multiRouteSpecifieds = $this->multiRoutes;

        $response = '';

        foreach ($routeSpecifieds as $key => $route) {
            $response .= $key > 0 ? ',' : '<b>Routes:</b><br> ';
            $response .= '<i>'.$route->name.'</i>';
        }

        $response = $response ? $response.'<br>' : $response;

        foreach ($multiRouteSpecifieds as $key => $route) {
            $response .= $key > 0 ? ',' : '<b>Multi Routes:</b><br> ';
            $response .= '<i>'.$route->alias.'</i>';
        }

        return $response;
    }
}
