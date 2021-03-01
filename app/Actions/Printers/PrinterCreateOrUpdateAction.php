<?php

namespace App\Actions\Printers;

use Illuminate\Support\Facades\DB;

use App\Models\Printer;

class PrinterCreateOrUpdateAction 
{
	protected $printer;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Printer $printer)
	{
		$this->printer = $printer;
	}

	/**
	 * Handles creating or updating of printer
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->printer = $this->printer->create($request->all());
			} else {
				$this->printer = Printer::withTrashed()->findOrFail($id);
				$this->printer->update($request->all());
			}
		DB::commit();

		return $this->printer;
	}
}