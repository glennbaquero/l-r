<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class DiscountOptionCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Type', 'Created By', 'Created At', 'Updated By', 'Updated At', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'option_name', 'option_type'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($option) {
            return [
                'option_name' => $option->option_name,
                'option_type' => $option->option_type,
                'created_by' => $option->creator->fullname,
                'updated_by' => $option->updater ? $option->updater->fullname : '---',
                'created_at' => Carbon::parse($option->created_at)->format('Y-m-d h:i A'),
                'updated_at' => $option->updater ? Carbon::parse($option->updated_at)->format('Y-m-d h:i A') : '---',
                'deleteUrl' => route('discount-option.destroy', $option->id),
                'showUrl' => route('discount-option.show', $option->id),
            ];
        });
    }
}
