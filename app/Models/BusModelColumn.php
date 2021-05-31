<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class BusModelColumn extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Append additional attributes
     * 
     * @var array
     */
    protected $appends = ['selected', 'showInputTypeText', 'showSelection', 'reservedForSelectedTrip'];

	/**
	 * Bus Model Column belongs to bus model row
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function row()
    {
        return $this->belongsTo(BusModelRow::class)->withTrashed();
    }


    /**
     * bus model column (seat) has many passengers
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    /**
     * bus model column (seat) has many tickets
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get selected
     * 
     * @return string
     */
    public function getSelectedAttribute()
    {
        return false;
    }

    /**
     * Get showInputTypeText
     * 
     * @return string
     */
    public function getShowInputTypeTextAttribute()
    {
        return false;
    }

    /**
     * Get ShowSelection
     * 
     * @return string
     */
    public function getShowSelectionAttribute()
    {
        return false;
    }

    /**
     * Get reservedForSelectedTrip
     * 
     * @return string
     */
    public function getReservedForSelectedTripAttribute()
    {
        return false;
    }
}
