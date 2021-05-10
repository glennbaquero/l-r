<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class PaymentDocumentCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Agent', 'Payment Type', 'Document Number', 'Amount', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        //
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($document) {
            return [
                'id' => $document->id,
                'agent' => $document->user->fullname,
                'payment_type' => $document->payment_type,
                'document_number' => $document->document_number,
                'amount' => number_format($document->amount, 2, '.', ','),
                'showUrl' => route('payment-document.show', $document->id),
                'deleteUrl' => route('payment-document.destroy', $document->id),
            ];
        });
    }
}
