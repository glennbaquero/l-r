<?php

namespace App\Actions\PaymentDocuments;

use Illuminate\Support\Facades\DB;

use App\Models\PaymentDocument;

class PaymentDocumentDeleteAction 
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
	 * Handles archiving of PaymentDocument
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->document = PaymentDocument::withTrashed()->findOrFail($id);
				$this->document->delete();
		DB::commit();


		return true;
	}
}