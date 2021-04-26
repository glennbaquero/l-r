<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class DiscountIncreaseOption extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
	
	/**
     * DiscountIncreaseOption belongs to User (created by)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

	/**
     * DiscountIncreaseOption belongs to User (updated by)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

     /**
      * getting types 
      * @return array
      */
    public static function getType() {
         return [
            ['value' => 'Discount', 'label' => 'Discount'],
            ['value' => 'Increase', 'label' => 'Increase'],
            ['value' => 'Plane Fare', 'label' => 'Plane Fare'],
        ];
    }
}
