<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PrinterCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Model', 'Brand', 'Code', 'Name', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'name', 'code'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($printer) {
            return [
                'name' => $printer->name,
                'code' => $printer->code,
                'brand' => $printer->printerBrand->name,
                'model' => $printer->printerModel->name,
                'showUrl' => route('printer.show', $printer->id),
                'deleteUrl' => route('printer.destroy', $printer->id),
            ];
        });
    }
}
