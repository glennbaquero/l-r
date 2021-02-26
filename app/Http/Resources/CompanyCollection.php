<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Code', 'Max Credit Line', 'Max Number Ticket', 'Discount', 'Actions'
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
        return $this->collection->map(function($company) {
            return [
                'name' => $company->name,
                'code' => $company->code,
                'max_credit_line' => $company->max_credit_line,
                'max_number_ticket' => $company->max_number_ticket,
                'discount' => $company->discount,
                'deleteUrl' => route('company.destroy', $company->id),
                'showUrl' => route('company.show', $company->id),
            ];
        });
    }
}
