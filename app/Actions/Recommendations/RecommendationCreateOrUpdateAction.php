<?php

namespace App\Actions\Recommendations;

use Illuminate\Support\Facades\DB;

use App\Models\Recommendation;
use App\Models\RecommendationPrivilege;

class RecommendationCreateOrUpdateAction 
{
	protected $recommendation;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Recommendation $recommendation)
	{
		$this->recommendation = $recommendation;
	}

	/**
	 * Handles creating or updating of Recommendation
	 */
	
	public function execute($request, $id = null)
	{
		$request['from_youtube'] = true;


		// if($request->hasFile('path')) {
		// 	$path = $request->file('path')->store('recommendations', 'public');
	 //        $request['file_path'] = $path;
		// }

		DB::beginTransaction();
			if(!$id) {
				$this->recommendation = $this->recommendation->create($request->except(['path']));
			} else {
				$this->recommendation = Recommendation::withTrashed()->findOrFail($id);
				$this->recommendation->update($request->except(['path']));
			}
		DB::commit();

		return $this->recommendation;
	}
}