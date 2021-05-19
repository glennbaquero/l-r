<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Coupon extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    protected $casts = [
       'trip_days' => 'array',
    ];


	/**
	 * Trip Type const
	 */
    const trip_type_all = 'All';
    const trip_type_one_way = 'One Way';
    const trip_type_roundtrip = 'Roundtrip';
    const trip_type_round = 'Round';

	/**
	 * Base Fare const
	 */
    const fare_all = 'All';
    const fare_flexible = 'Flexible';
    const fare_standard = 'Standard';
    const fare_web = 'Web Fare';

	/**
	 * Coupon Type const
	 */
    const coupon_type_percentage = 'Percentage';
    const coupon_type_amount = 'Amount';
    const coupon_type_fixed = 'Fixed';

	/**
	 * Filter by date const
	 */
    const filter_date_travel = 'Travel';
    const filter_date_purchase = 'Purchase';
    const filter_date_both = 'Both';

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
     * Coupon belongs to many services
     * 
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * Coupon belongs to many ticket types
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
     * Coupon hasMany general route
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function generalRoutes()
    {
        return $this->hasMany(CouponGeneralRoute::class)->withTrashed();
    }

    /**
     * Coupon hasMany tickets
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'voucher_code', 'code');
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
	        ['id' => static::trip_type_round, 'value' => static::trip_type_round, 'label' => static::trip_type_round],
	    ];
	}

	/**
	  * getting base fare
	  * @return array
	  */
	public static function getBaseFare() {
	     return [
	        ['id' => static::fare_all, 'value' => static::fare_all, 'label' => static::fare_all],
	        ['id' => static::fare_flexible, 'value' => static::fare_flexible, 'label' => static::fare_flexible],
	        ['id' => static::fare_standard, 'value' => static::fare_standard, 'label' => static::fare_standard],
	        ['id' => static::fare_web, 'value' => static::fare_web, 'label' => static::fare_web],
	    ];
	}

	/**
	  * getting coupon type
	  * @return array
	  */
	public static function getCouponType() {
	     return [
	        ['id' => static::coupon_type_percentage, 'value' => static::coupon_type_percentage, 'label' => static::coupon_type_percentage],
	        ['id' => static::coupon_type_amount, 'value' => static::coupon_type_amount, 'label' => static::coupon_type_amount],
	        ['id' => static::coupon_type_fixed, 'value' => static::coupon_type_fixed, 'label' => static::coupon_type_fixed],
	    ];
	}

	/**
	  * getting filter date
	  * @return array
	  */
	public static function getFilterDate() {
	     return [
	        ['id' => static::filter_date_travel, 'value' => static::filter_date_travel, 'label' => static::filter_date_travel],
	        ['id' => static::filter_date_purchase, 'value' => static::filter_date_purchase, 'label' => static::filter_date_purchase],
	        ['id' => static::filter_date_both, 'value' => static::filter_date_both, 'label' => static::filter_date_both],
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

}
