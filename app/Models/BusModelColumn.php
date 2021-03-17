<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class BusModelColumn extends Model
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
    protected $appends = ['selected', 'showInputTypeText', 'showSelection'];

	/**
	 * Bus Model Column belongs to bus model row
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function row()
    {
        return $this->belongsTo(BusModelRow::class)->withTrashed();
    }

    /**
     * Get selected
     * 
     * @return string
     */
    public function getSelectedAttribute()
    {
        return false;
    }

    /**
     * Get showInputTypeText
     * 
     * @return string
     */
    public function getShowInputTypeTextAttribute()
    {
        return false;
    }

    /**
     * Get ShowSelection
     * 
     * @return string
     */
    public function getShowSelectionAttribute()
    {
        return false;
    }
}
