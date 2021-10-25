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
    protected $appends = ['display_trip_name', 'formatted_date', 'formatted_time', 'route_name'];

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
     * Trip has many tickets
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
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
     * Trip has many TripTime
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function times()
    {
        return $this->hasMany(TripTime::class);
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

    /**
     * append formatted date
     * 
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('m-d-Y');
    }

    /**
     * append formatted time
     * 
     * @return string
     */
    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->time)->format('h:i A');
    }

    /**
     * append route name
     * 
     * @return string
     */
    public function getRouteNameAttribute()
    {
        return $this->route->alias;
    }

    /**
     * Get tickets sold in specific trip
     */
    
    public function getTickets()
    {
        $ticket_list = [];
        foreach ($this->tickets as $key => $ticket) {
            array_push($ticket_list, [
                'id' => $ticket->id,
                'departure' => $ticket->departure->name,                
                'arrival' => $ticket->arrival->name,                
                'seat' => $ticket->seat->label,                
                'ticket_type' => $ticket->passenger->ticketType->name,                
                'passenger' => $ticket->passenger->fullname,                
                'seller' => $ticket->seller->fullname,                
                'office' => $ticket->seller->office->name,                
            ]);
        }

        return $ticket_list;
    }

    /**
     * Get bus seat available
     */
    
    public function getAvailableSeat()
    {
        $available = 0;
        foreach ($this->bus->bus_model->bus_rows as $row) {
            foreach ($row->bus_columns as $column) {
                foreach($this->passengers as $passenger) {
                    if($column->label != null || $column->label != '') {
                        if($passenger->bus_model_column_id != $column->id) {
                            $available += 1;
                        }
                    }
                }
            }
           // array_push($available, $row->bus_columns);
        }

        return $available;
    }

    /**
     * Get formatted time
     */
    
    public function formattedTripTime()
    {
        // $time = [];
        // foreach($this->times as $item) {
        //     $time[] = Carbon::parse($item->time)->format('h:i A'). '('.$item->driver->fullname.')';
        // }

        // return implode(', ', $time);
        return null;
    }
}
