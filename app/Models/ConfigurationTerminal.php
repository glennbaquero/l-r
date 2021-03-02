<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class ConfigurationTerminal extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * Configuration Terminal can belongs to office
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function office()
    {
        return $this->belongsTo(Office::class)->withTrashed();
    }

	/**
	 * Configuration Terminal can belongs to printer brand
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function printerBrand()
    {
        return $this->belongsTo(PrinterBrand::class)->withTrashed();
    }

	/**
	 * Configuration Terminal can belongs to printer
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function printer()
    {
        return $this->belongsTo(Printer::class)->withTrashed();
    }
}
