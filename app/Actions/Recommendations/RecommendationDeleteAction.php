<?php

namespace App\Actions\Recommendations;

use Illuminate\Support\Facades\DB;

use App\Models\Recommendation;

class RecommendationDeleteAction 
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
	 * Handles archiving of recommendation
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->recommendation = Recommendation::withTrashed()->findOrFail($id);
				$this->recommendation->delete();
		DB::commit();


		return true;
	}
}