<?php

namespace App\Actions\GroupPrivileges;

use Illuminate\Support\Facades\DB;

use App\Models\Group;
use App\Models\GroupPrivilege;

class GroupPrivilegeCreateOrUpdateAction 
{
	protected $privilege;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(GroupPrivilege $privilege)
	{
		$this->privilege = $privilege;
	}

	/**
	 * Handles creating or updating of Privilege
	 */
	
	public function execute($groupId, $groupPrivilegeId)
	{
		DB::beginTransaction();
			$this->privilege = GroupPrivilege::find($groupPrivilegeId);
			$privilege = $this->privilege->groups()->newPivotStatement()->where('group_id', $groupId)->where('group_privilege_id', $groupPrivilegeId)->first()->selected;

			$privilege = $privilege ? false : true;

			$this->privilege->groups()->newPivotStatement()->where('group_id', $groupId)->where('group_privilege_id', $groupPrivilegeId)->update(['selected' => $privilege]);
		DB::commit();

		return $this->privilege;
	}
}