<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryLike;

class Voucher extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    const type_amount = 'Amount';
    const type_courtesy = 'Max. Courtesy Ticket';
    const type_ticket_discount = 'Max. Ticket % Discount';

    /**
     * Voucher belongs to passenger
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function passenger()
     {
         return $this->belongsTo(Passenger::class)->withTrashed();
     }
     
     /**
      * Voucher belongs to tickets
      * 
      * @return Illuminate\Database\Eloquent\Relations\BelongsTo
      */
      public function tickets()
      {
          return $this->hasMany(Ticket::class, 'voucher_code', 'code');
      }

     /**
      * getting types 
      * @return array
      */
    public static function getType() {
         return [
            ['value' => static::type_amount, 'label' => static::type_amount],
            ['value' => static::type_courtesy, 'label' => static::type_courtesy],
            ['value' => static::type_ticket_discount, 'label' => static::type_ticket_discount],
        ];
    }
}
