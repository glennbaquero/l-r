<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class ExpenseIncome extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Expense Income belongs to Authorized Person (user)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function authorizedPerson()
     {
         return $this->belongsTo(User::class, 'authorized_by')->withTrashed();
     }

    /**
     * Expense Income belongs to Created By (user)
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function creator()
     {
         return $this->belongsTo(User::class, 'created_by')->withTrashed();
     }


     /**
      * getting expenses types 
      * @return array
      */
    public static function getExpensesType() {
         return [
            ['value' => 'Other', 'label' => 'Other', 'showTravel' => false],
            ['value' => 'Refund Penalty', 'label' => 'Refund Penalty', 'showTravel' => false],
            ['value' => 'Transport or Transfer', 'label' => 'Transport or Transfer', 'showTravel' => false],
            ['value' => 'Entrega rendir cuentas', 'label' => 'Entrega rendir cuentas', 'showTravel' => true],
            ['value' => 'Gastos de viaje', 'label' => 'Gastos de viaje', 'showTravel' => true],
            ['value' => 'Gasoline or Diesel', 'label' => 'Gasoline or Diesel', 'showTravel' => true],
            ['value' => 'Tolls', 'label' => 'Tolls', 'showTravel' => true],
            ['value' => 'Travel Expenses', 'label' => 'Travel Expenses', 'showTravel' => true],
            ['value' => 'Refund', 'label' => 'Refund', 'showTravel' => false],
            ['value' => 'Money Order Fee', 'label' => 'Money Order Fee', 'showTravel' => false],
            ['value' => 'Car wash supplies', 'label' => 'Car wash supplies', 'showTravel' => false],
            ['value' => 'Phone Compensation', 'label' => 'Phone Compensation', 'showTravel' => false],
            ['value' => 'Office Materials', 'label' => 'Office Materials', 'showTravel' => false],
            ['value' => 'Auto Parts', 'label' => 'Auto Parts', 'showTravel' => true],
            ['value' => 'Advertising and Marketing', 'label' => 'Advertising and Marketing', 'showTravel' => false],
            ['value' => 'Change of Ticket', 'label' => 'Change of Ticket', 'showTravel' => false],
            ['value' => 'Comision de ventas', 'label' => 'Comision de ventas', 'showTravel' => true],
            ['value' => 'Por detracciones', 'label' => 'Por detracciones', 'showTravel' => false],
        ];
    }

     /**
      * getting income types 
      * @return array
      */
    public static function getIncomeType() {
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
