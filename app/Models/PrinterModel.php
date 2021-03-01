<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class PrinterModel extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Print model belongs to Printer Model
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function printerBrand()
    {
        return $this->belongsTo(PrinterBrand::class);
    }
}
