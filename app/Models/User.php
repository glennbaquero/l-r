<?php

namespace App\Models;

use App\Traits\QueryLike;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Password;

class User extends Authenticatable
{
    use HasFactory, Notifiable, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Overrides default forgot password */
    public function broker() 
    {
        return Password::broker('users');
    }

    /**
     * Append additional attributes
     * 
     * @var array
     */
    protected $appends = ['fullname', 'full_image_path', 'postal_code', 'total_ticket_sold'];

    /**
     * Get user fullname
     * 
     * @return string
     */
    public function getFullnameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    /**
     * Get user image
     * 
     * @return string
     */
    public function getFullImagePathAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : asset('/storage/images/default-avatar.png');
    }

    /**
     * Get postal code
     * 
     * @return string
     */
    public function getPostalCodeAttribute()
    {
        return $this->zip_code;
    }

    /**
     * Get postal code
     * 
     * @return string
     */
    public function getTotalTicketSoldAttribute()
    {
        return $this->tickets->sum('total_sale');
    }

    /**
    * User belongs to office
    * 
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function office()
   {
       return $this->belongsTo(Office::class, 'office_id', 'id')->withTrashed();
   }

   /**
    * User belongs to group
    * 
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function group()
    {
        return $this->belongsTo(Group::class)->withTrashed();
    }

    /**
     * User belongs to many group messages
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function group_messages()
    {
        return $this->belongsToMany(GroupMessage::class);
    }

    /**
    * User hasMany cash
    * 
    * @return Illuminate\Database\Eloquent\Relations\hasMany
    */
   public function cashes()
   {
       return $this->hasMany(Cash::class);
   }

    /**
    * User hasMany tickets
    * 
    * @return Illuminate\Database\Eloquent\Relations\hasMany
    */
   public function tickets()
   {
       return $this->hasMany(Ticket::class, 'seller_id', 'id');
   }



   public function getTotalSoldTickets($start_date, $date_type, $end_date)
   {
        if($date_type == 'true') {
            return $this->tickets->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->sum('total_sale');
        }
        
        return $this->tickets->where('created_at', '>=', $start_date)->sum('total_sale');    
   }
}
