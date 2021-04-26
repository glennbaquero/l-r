<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class ExpenseIncomeCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Record Date', 'Document', 'Authorized', 'Office', 'Username', 'Concept', 'Amount', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'authorized', 'office', 'created_by'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($item) {
            return [
                'created_at' => Carbon::parse($item->created_at)->format('Y-m-d h:i A'),
                'document' => $item->type == 'Income' ? 'RECIBO_INGRESO' : 'RECIBO_EGRESO',
                'authorized_by' => $item->authorizedPerson->fullname,
                'office' => $item->creator->office->name,
                'created_by' => $item->creator->fullname,
                'concept' => $item->concept,
                'amount' => $item->amount,
                'showUrl' => route('expense-income.show', $item->id),
                'deleteUrl' => route('expense-income.destroy', $item->id),
            ];
        });
    }
}
