<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Printer extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Printer belongs to Printer Brand
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function printerBrand()
    {
        return $this->belongsTo(PrinterBrand::class)->withTrashed();
    }

    /**
     * Printer belongs to Printer Model
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function printerModel()
    {
        return $this->belongsTo(PrinterModel::class)->withTrashed();
    }
}
