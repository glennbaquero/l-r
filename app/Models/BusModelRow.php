<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class BusModelRow extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	/**
	 * Bus Model Row belongs to bus model
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function model()
    {
        return $this->belongsTo(BusModel::class)->withTrashed();
    }

    /**
     * Bus Model row has many columns
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bus_columns()
    {
        return $this->hasMany(BusModelColumn::class);
    }
}
