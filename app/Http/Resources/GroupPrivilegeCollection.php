<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupPrivilegeCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Menu / Action'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'menu'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($privilege) {
            return [
                'id' => $privilege->id,
                'menu' => $privilege->menu,
                'group_values' => $privilege->groups()->get(['selected', 'id']),
               
                'showUrl' => route('group.show', $privilege->id),
                'deleteUrl' => route('group.destroy', $privilege->id),
            ];
        });
    }
}
