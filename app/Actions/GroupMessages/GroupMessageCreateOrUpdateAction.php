<?php

namespace App\Actions\GroupMessages;

use Illuminate\Support\Facades\DB;

use App\Models\GroupMessage;
use App\Models\User;

class GroupMessageCreateOrUpdateAction 
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
	 * Handles creating or updating of GroupMessage
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->group = $this->group->create($request->only(['name']));
			} else {
				$this->group = GroupMessage::withTrashed()->findOrFail($id);
				$this->group->update($request->only(['name']));
			}
			
			$this->group->users()->sync($request->userIds);
			
		DB::commit();

		return $this->group;
	}
}