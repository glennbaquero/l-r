<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Illuminate\Notifications\Notification;

use App\Traits\QueryLike;

class Passenger extends Model
{
    use HasFactory, QueryLike, SoftDeletes, Notifiable;

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
    protected $appends = ['fullname', 'infant_fullname'];


	/**
	 * Passenger belongs to bus model column (seat)
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function bus_model_column()
    {
        return $this->belongsTo(BusModelColumn::class)->withTrashed();
    }

	/**
	 * Passenger belongs to city (arrival)
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function arrival()
    {
        return $this->belongsTo(City::class, 'arrival_city_id', 'id')->withTrashed();
    }

	/**
	 * Passenger belongs to trip
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function trip()
    {
        return $this->belongsTo(Trip::class)->withTrashed();
    }

    /**
     * Passenger belongs to Ticket Type
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketType()
    {
        return $this->belongsTo(TicketType::class)->withTrashed();
    }

    /**
     * Passenger has one ticket
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticket()
    {
        return $this->hasOne(Ticket::class)->withTrashed();
    }

    /**
     * Passenger has many vouchers
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }


    /**
     * Get user fullname
     * 
     * @return string
     */
    public function getFullnameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get user fullname
     * 
     * @return string
     */
    public function getInfantFullnameAttribute()
    {
        return "{$this->infant_firstname} {$this->infant_lastname}";
    }

    /**
     * Return the SMS notification routing information.
     *
     * @param \Illuminate\Notifications\Notification|null $notification
     *
     * @return mixed
     */
    public function routeNotificationForSms(?Notification $notication = null)
    {
        return $this->phone_number;
    }

}
