<?php

namespace App\Actions\PaymentDocuments;

use Illuminate\Support\Facades\DB;

use App\Models\PaymentDocument;

class PaymentDocumentCreateOrUpdateAction 
{
	protected $document;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(PaymentDocument $document)
	{
		$this->document = $document;
	}

	/**
	 * Handles creating or updating of payment document
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->document = $this->document->create($request->all());
			} else {
				$this->document = PaymentDocument::withTrashed()->findOrFail($id);
				$this->document->update($request->all());
			}
		DB::commit();


		return $this->document;
	}
}