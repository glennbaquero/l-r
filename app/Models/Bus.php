<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Bus extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	/**
	 * Bus belongs to bus model
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function bus_model()
    {
        return $this->belongsTo(BusModel::class)->withTrashed();
    }

    public function getTotalSeat() 
    {
        $rows = $this->bus_model->bus_rows;
        $total_seat = 0;
        foreach($rows as $row) {
            $total_seat += $row->bus_columns()->whereNotNull('label')->whereNotNull('image_path')->get()->count();
        }

        return $total_seat;
    }
}
