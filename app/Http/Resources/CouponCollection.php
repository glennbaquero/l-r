<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class CouponCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
        'Code', 'Creation Date', 'Alias', 'Coupon Name', 'Coupon Type', 'Currency', 'Value', 'Total', 'Available', 'Filter', 'Day', 'Term', 'Days', 'Route', 'Schedules', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'code', 'created_at', 'name', 'type', 'value', 'alias'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($coupon) {
            return [
                'code' => $coupon->code,
                'created_at' => Carbon::parse($coupon->created_at)->format('Y-m-d'),
                'name' => $coupon->promotion_name,
                'promotion_alias' => $coupon->promotion_alias,
                'coupon_type' => $coupon->coupon_type,
                'currency' => 'Dollars',
                'value' => $coupon->value,
                'total' => $coupon->coupon_used + $coupon->coupon_available,
                'coupon_available' => $coupon->coupon_available,
                'filter' => '---',
                'day' => '---',
                'term' => '---',
                'days' => '---',
                'route' => '---',
                'schedule' => '---',
                'showUrl' => route('coupon.show', $coupon->id),
                'deleteUrl' => route('coupon.destroy', $coupon->id),
            ];
        });
    }
}
