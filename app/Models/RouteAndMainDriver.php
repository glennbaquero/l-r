<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class RouteAndMainDriver extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * RouteAndMainDriver belongs to Departure (City)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departure()
    {
        return $this->belongsTo(City::class, 'departure_id', 'id')->withTrashed();
    }

    /**
     * RouteAndMainDriver belongs to Arrival (City)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arrival()
    {
        return $this->belongsTo(City::class, 'arrival_id', 'id')->withTrashed();
    }

    /**
     * RouteAndMainDriver belongs to driver
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class)->withTrashed();
    }

     /**
      * getting types 
      * @return array
      */
    public static function getType() {
         return [
            ['value' => 'Other', 'label' => 'Other', 'showTravel' => false],
            ['value' => 'Positive Till', 'label' => 'Positive Till', 'showTravel' => false],
            ['value' => 'Refund Penalty', 'label' => 'Refund Penalty', 'showTravel' => false],
            ['value' => 'Miscellaneous', 'label' => 'Miscellaneous', 'showTravel' => false],
            ['value' => 'Van Service', 'label' => 'Van Service', 'showTravel' => false],
            ['value' => 'Money Order', 'label' => 'Money Order', 'showTravel' => false],
            ['value' => 'Ingreso a Caja por venta de bebidas', 'label' => 'Ingreso a Caja por venta de bebidas', 'showTravel' => false],
            ['value' => 'Ingreso a Caja por venta de bocaditos', 'label' => 'Ingreso a Caja por venta de bocaditos', 'showTravel' => false],
            ['value' => 'Ingreso a Caja por reimpresión de documento', 'label' => 'Ingreso a Caja por reimpresión de documento', 'showTravel' => false],
            ['value' => 'Ingreso a Caja por cambio de pasajero', 'label' => 'Ingreso a Caja por cambio de pasajero', 'showTravel' => false],
        ];
    }
}
