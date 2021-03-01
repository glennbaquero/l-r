<?php

namespace App\Actions\GroupMessages;

use Illuminate\Support\Facades\DB;

use App\Models\GroupMessage;

class GroupMessageDeleteAction 
{
	protected $group;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(GroupMessage $group)
	{
		$this->group = $group;
	}

	/**
	 * Handles archiving of GroupMessage
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->group = GroupMessage::withTrashed()->findOrFail($id);
				$this->group->delete();
		DB::commit();


		return true;
	}
}