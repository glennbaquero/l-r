<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Route extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Route belongs to Departure (City)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departure()
    {
        return $this->belongsTo(City::class, 'departure_id', 'id')->withTrashed();
    }
    
    /**
     * Route has many Stops
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stops()
    {
        return $this->hasMany(Stop::class);
    }

    /**
     * Route has many Trips
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
