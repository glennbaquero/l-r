<?php

namespace App\Http\Fetch;

use App\Models\PaymentDocument;

class PaymentDocumentFetch
{
    protected $document;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(PaymentDocument $document)
    {
        $this->document = $document;
    }

    /**
     * Handles querying of payment document model
     * 
     * @param array $params
     * @return mixed $document
     */
    public function execute($params)
    {
        return $this->document->paginate(20);
    }
}