<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class DiscountCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
        'ID', 'Applicable', 'Option', 'Exchange Rate', 'Filter', 'Day', 'Term', 'Days', 'Apply', 'Route/Multiroute', 'Schedules', 'Type', 'Amount', 'Partnerships', 'Preview', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'id', 'applicable', 'option', 'change_type', 'filter_by', 'date', 'end_date', 'type', 'amount', 'partnership', 'apply_to', 'filter_day'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($discount) {
            $days = $discount->getDays();
            $days = $days === 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday' ? 'All' : $days;
            $route = $discount->getRouteName();

            // dd($route);
            return [
                'id' => $discount->id,
                'promotion_apply_to' => $discount->promotion_apply_to,
                'option' => $discount->option,
                'change_type' => $discount->change_type,
                'filter_by' => $discount->filter_by,
                'date' => $discount->date,
                'end_date' => $discount->end_date,
                'days' => $days,
                'apply_to' => $discount->apply_to,
                'route' => $route,
                'schedules' => 'All',
                'type' => $discount->type,
                'amount' => $discount->amount,
                'partnership' => $discount->partnership,
                'preview' => 'No',
                'showUrl' => route('discount.show', $discount->id),
                'deleteUrl' => route('discount.destroy', $discount->id),
            ];
        });
    }
}
