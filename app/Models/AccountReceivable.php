<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class AccountReceivable extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * AccountReceivable belongs to PaymentDocument
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_document()
    {
        return $this->belongsTo(PaymentDocument::class)->withTrashed();
    }

    /**
     * AccountReceivable belongs to user
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
