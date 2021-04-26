<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class PromotionRouteSpecified extends Model
{
	use HasFactory, QueryLike, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * PromotionRouteSpecified belongsTo Promotion
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function promotion()
	{
	    return $this->belongsTo(Promotion::class)->withTrashed();
	}

	/**
	 * PromotionRouteSpecified belongsTo Route
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function route()
	{
	    return $this->belongsTo(Route::class)->withTrashed();
	}
}
