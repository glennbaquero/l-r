<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

use Carbon\Carbon;

class PreprocessTicket extends Model
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
    protected $appends = ['formatted_purchase_date', 'formatted_travel_date', 'passenger_gender'];

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

    /**
     * Ticket belongs to office
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id')->withTrashed();
    }

    /**
     * Ticket belongs to Departure (City)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departure()
    {
        return $this->belongsTo(City::class, 'departure_id', 'id')->withTrashed();
    }

    /**
     * Ticket belongs to Arrival (City)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arrival()
    {
        return $this->belongsTo(City::class, 'arrival_id', 'id')->withTrashed();
    }

    /**
     * Ticket belongs to trip
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class)->withTrashed();
    }

    /**
     * Ticket belongs to Bus Column (seat)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seat()
    {
        return $this->belongsTo(BusModelColumn::class, 'bus_model_column_id', 'id')->withTrashed();
    }

    /**
     * Ticket belongs to voucher
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function voucher()
     {
         return $this->belongsTo(Voucher::class, 'voucher_code', 'code')->withTrashed();
     }

    /**
     * Ticket belongsTo TripTime
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trip_time()
    {
        return $this->belongsTo(TripTime::class);
    }

    /**
     * Ticket belongsTo Driver
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class)->withTrashed();
    }



    /**
     * Get formatted purchase date
     * 
     * @return string
     */
    public function getFormattedPurchaseDateAttribute()
    {
        return Carbon::parse($this->purchase_date)->format('m-d-Y h:i A');
    }
    /**
     * Get formatted purchase date
     * 
     * @return string
     */
    public function getFormattedTravelDateAttribute()
    {
        return Carbon::parse($this->trip->date)->format('m-d-Y').' '.Carbon::parse($this->trip->time)->format('h:i A');
    }
    /**
     * Get passenger gender
     * 
     * @return string
     */
    public function getPassengerGenderAttribute()
    {
        return $this->passenger->gender;
    }

    /**
     * Get update status url
     * 
     * @return string
     */
    public function updateStatusUrl()
    {
        return route('ticket.status', ['not yet been process']);
    }

    /**
     * Get payment form url
     * 
     * @return string
     */
    public function paymentFormUrl()
    {
        return route('payment.form', [$this->ticket_number, $this->passenger->fullname, $this->arrival->name, $this->departure->name]);
    }
}
