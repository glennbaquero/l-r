<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class CouponGeneralRoute extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * CouponGeneralRoute belongsTo Coupon
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function coupon()
	{
	    return $this->belongsTo(Coupon::class)->withTrashed();
	}

	/**
	 * CouponGeneralRoute belongsTo City (departure)
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function departure()
	{
	    return $this->belongsTo(City::class, 'departure_id', 'id')->withTrashed();
	}

	/**
	 * CouponGeneralRoute belongsTo City (arrival)
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function arrival()
	{
	    return $this->belongsTo(City::class, 'arrival_id', 'id')->withTrashed();
	}
}
