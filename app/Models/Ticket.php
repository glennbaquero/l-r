<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Ticket extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	/**
	 * Ticket belongs to passenger
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function passenger()
    {
        return $this->belongsTo(Passenger::class)->withTrashed();
    }

	/**
	 * Ticket belongs to seller (user logged in)
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id')->withTrashed();
    }
}
