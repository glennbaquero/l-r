<?php

namespace App\Actions\Printers;

use Illuminate\Support\Facades\DB;

use App\Models\Printer;

class PrinterDeleteAction 
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
	 * Handles archiving of Printer
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->printer = Printer::withTrashed()->findOrFail($id);
				$this->printer->delete();
		DB::commit();


		return true;
	}
}