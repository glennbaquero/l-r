<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'See Messages', 'Write Posts', 'Send Posts', 'Can Sell Open', 'Authorized', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'name'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($group) {
            return [
                'name' => $group->name,
                'see_message' => $group->see_message,
                'write_post' => $group->write_post,
                'send_post' => $group->send_post,
                'authorized_power' => $group->authorized_power,
                'can_sell_open' => $group->can_sell_open,
                'download_report' => $group->download_report,
                'showUrl' => route('group.show', $group->id),
                'deleteUrl' => route('group.destroy', $group->id),
            ];
        });
    }
}
