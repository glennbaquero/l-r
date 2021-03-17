<?php

namespace App\Actions\Cells;

use Illuminate\Support\Facades\DB;

use App\Models\Cell;

class CellDeleteAction 
{
	protected $cell;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Cell $cell)
	{
		$this->cell = $cell;
	}

	/**
	 * Handles archiving of cell
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->cell = Cell::withTrashed()->findOrFail($id);
				$this->cell->delete();
		DB::commit();


		return true;
	}
}