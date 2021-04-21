<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryLike;

class MultiRouteStop extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Multi Route Stop belongs to MultiRoute
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(MultiRoute::class)->withTrashed();
    }

    /**
     * Multi Route Stop belongs to MultiRoute
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function routes()
    {
        return $this->belongsToMany(Route::class);
    }
    
    /**
     * Multi Route Stop belongs to Departure (City)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departure()
    {
        return $this->belongsTo(City::class, 'departure_id', 'id');
    }

    /**
     * Multi Route Stop belongs to Arrival (City)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arrival()
    {
        return $this->belongsTo(City::class, 'arrival_id', 'id');
    }
}
