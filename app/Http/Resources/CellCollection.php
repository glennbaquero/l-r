<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CellCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Icon', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'name', 'icon'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($cell) {
            return [
                'name' => $cell->name,
                'icon' => $cell->icon,
                'image_path' => url($cell->image_path),
                'showUrl' => route('cell.show', $cell->id),
                'deleteUrl' => route('cell.destroy', $cell->id),
            ];
        });
    }
}
