<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class BusModel extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	/**
	 * Bus Model belongs to cell
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function cell()
    {
        return $this->belongsTo(Cell::class, 'default_cell_id', 'id')->withTrashed();
    }

    /**
     * Bus Model has many row
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bus_rows()
    {
        return $this->hasMany(BusModelRow::class);
    }

    /**
     * Bus Model has many bus
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
