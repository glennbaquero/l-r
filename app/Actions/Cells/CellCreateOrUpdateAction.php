<?php

namespace App\Actions\Cells;

use Illuminate\Support\Facades\DB;

use App\Models\Cell;

class CellCreateOrUpdateAction 
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
	 * Handles creating or updating of cell
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->cell = $this->cell->create($request->all());
			} else {
				$this->cell = Cell::withTrashed()->findOrFail($id);
				$this->cell->update($request->all());
			}
		DB::commit();


		return $this->cell;
	}
}