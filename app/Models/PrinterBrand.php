<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class PrinterBrand extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Print brand has many Printer Models
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function printerModels()
    {
        return $this->hasMany(PrinterModel::class);
    }

    /**
     * Print brand has many Printers
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function printers()
    {
        return $this->hasMany(Printer::class);
    }
}
