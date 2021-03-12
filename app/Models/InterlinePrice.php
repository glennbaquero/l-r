<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class InterlinePrice extends Model
{
    use HasFactory, SoftDeletes, QueryLike;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Price belongs to departure city
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departure()
    {
        return $this->belongsTo(City::class, 'departure_id', 'id');
    }

    /**
     * Price belongs to arrival city
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arrival()
    {
        return $this->belongsTo(City::class, 'arrival_id', 'id');
    }

    /**
     * Price belongs to Currency
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id')->withTrashed();
    }

    /**
     * Price belongs to company
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')->withTrashed();
    }
    
}
