<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class PaymentDocument extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Payment Document const
     */
    const sales_pending_receipt = 'Sales Pending Receipt';
    const payment_by_check = 'Payment by Check';
    const pay_with_credit_card = 'I pay with credit card';
    const credit_cancellation_adjustment = 'Credit for cancellation or adjustment';

    /**
     * PaymentDocument belongs to AccountReceivable
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountReceivables()
    {
        return $this->hasMany(AccountReceivable::class)->withTrashed();
    }

    /**
     * PaymentDocument belongs to User
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }


    /**
      * getting payment docuement
      * @return array
      */
    public static function getPaymentDocument() {
         return [
            ['id' => static::sales_pending_receipt, 'value' => static::sales_pending_receipt, 'label' => static::sales_pending_receipt],
            ['id' => static::payment_by_check, 'value' => static::payment_by_check, 'label' => static::payment_by_check],
            ['id' => static::pay_with_credit_card, 'value' => static::pay_with_credit_card, 'label' => static::pay_with_credit_card],
            ['id' => static::credit_cancellation_adjustment, 'value' => static::credit_cancellation_adjustment, 'label' => static::credit_cancellation_adjustment],
        ];
    }
}
