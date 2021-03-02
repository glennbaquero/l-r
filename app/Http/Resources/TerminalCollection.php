<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TerminalCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Office', 'Browser', 'Web Browser', 'Printer', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'office'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($terminal) {
            return [
                'operating_system' => $terminal->operating_system,
                'web_browser' => $terminal->web_browser,
                'printer' => $terminal->printer->name,
                'office_id' => $terminal->office_id,
                'office_name' => $terminal->office ? $terminal->office->name : '---',
                'deleteUrl' => route('terminal.destroy', $terminal->id),
                'showUrl' => route('terminal.show', $terminal->id),
            ];
        });
        // })->groupby('office_id');
    }
}
