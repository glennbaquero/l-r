<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class DiscountGeneralRoute extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * DiscountGeneralRoute belongsTo discount
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function discount()
	{
	    return $this->belongsTo(Discount::class)->withTrashed();
	}

	/**
	 * DiscountGeneralRoute belongsTo City (departure)
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function departure()
	{
	    return $this->belongsTo(City::class, 'departure_id', 'id')->withTrashed();
	}

	/**
	 * DiscountGeneralRoute belongsTo City (arrival)
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function arrival()
	{
	    return $this->belongsTo(City::class, 'arrival_id', 'id')->withTrashed();
	}
}
