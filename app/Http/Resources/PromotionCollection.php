<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class PromotionCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Type', 'Assigned Value', 'Equivalence', 'Filter', 'Days', 'Apply', 'Route', 'Schedule', 'Action'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        //
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($promotion) {
            $days = $promotion->days ? implode(',', json_decode($promotion->days))  : '---';
            $route = $promotion->getRouteName();

            return [
                'type' => $promotion->type,
                'value' => $promotion->value,
                'point_equivalent' => $promotion->point_equivalent,
                'filter_by' => $promotion->filter_by,
                'date' =>'---',
                'terms' =>'---',
                'days' => $days,
                'apply' => $promotion->apply_to,
                'route' => $route != '' ? $route : '---',
                'schedule' => $promotion->date . ' '.($promotion->filter_by == 'Date Range' ? ' to '. $promotion->end_date : '')  ,
                'showUrl' => route('promotion.show', $promotion->id),
                'deleteUrl' => route('promotion.destroy', $promotion->id),
            ];
        });
    }
}
