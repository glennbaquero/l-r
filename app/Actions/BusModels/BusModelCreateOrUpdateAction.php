<?php

namespace App\Actions\BusModels;

use Illuminate\Support\Facades\DB;

use App\Models\BusModel;
use App\Models\BusModelRow;
use App\Models\BusModelColumn;

class BusModelCreateOrUpdateAction 
{
	protected $model;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(BusModel $model)
	{
		$this->model = $model;
	}

	/**
	 * Handles creating or updating of BusModel
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->model = $this->model->create($request->except(['cells', 'updateType']));
			} else {
				$this->model = BusModel::withTrashed()->findOrFail($id);
				$this->model->update($request->except(['cells', 'updateType']));

				foreach ($this->model->bus_rows as $row) {
					$row->bus_columns()->forceDelete();
				}

				$this->model->bus_rows()->forceDelete();

			}

			foreach (json_decode($request->cells) as $row) {
				$bus_row = BusModelRow::create([ 'bus_model_id' => $this->model->id ]);

				foreach ($row as $column) {
					BusModelColumn::create([
						'bus_model_row_id' => $bus_row->id,
						'image_path' => $column->image_path,
						'label' => $column->label,
						'orientation' => $column->orientation,
					]);
				}
			}
		DB::commit();


		return $this->model;
	}
}