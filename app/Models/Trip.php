<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

use Carbon\Carbon;

class Trip extends Model
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
    protected $appends = ['display_trip_name'];

    /**
     * Trip belongs to route
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id')->withTrashed();
    }

    /**
     * Trip belongs to company
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Trip belongs to service
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    /**
     * Trip belongs to bus
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    /**
     * Trip belongs to driver
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    /**
     * Trip belongs to main co driver
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function main_co_driver()
    {
        return $this->belongsTo(Driver::class, 'main_co_driver_id', 'id');
    }

    /**
     * Trip belongs to secondary co driver
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secondary_co_driver()
    {
        return $this->belongsTo(Driver::class, 'secondary_co_driver_id', 'id');
    }

    /**
     * Trip has many expenses
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Trip has many passengers
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }


    /**
     * Get display trip name
     * 
     * @return string
     */
    public function getDisplayTripNameAttribute()
    {
        return $this->date.'|'.Carbon::parse($this->time)->format('h:i A'). ' '.$this->alias_route;
    }
}
