<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BusModelCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Rows', 'Columns', 'Floors', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'name', 'rows', 'columns', 'floors'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($model) {
            return [
                'name' => $model->name,
                'rows' => $model->rows,
                'columns' => $model->columns,
                'floors' => $model->floors,
                'showUrl' => route('bus-model.show', $model->id),
                'deleteUrl' => route('bus-model.destroy', $model->id),
            ];
        });
    }
}
