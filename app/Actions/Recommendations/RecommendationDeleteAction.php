<?php

namespace App\Actions\Groups;

use Illuminate\Support\Facades\DB;

use App\Models\Group;

class GroupDeleteAction 
{
	protected $group;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Group $group)
	{
		$this->group = $group;
	}

	/**
	 * Handles archiving of Group
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->group = Group::withTrashed()->findOrFail($id);
				$this->group->delete();
		DB::commit();


		return true;
	}
}