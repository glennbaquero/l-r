<?php

namespace App\Actions\Groups;

use Illuminate\Support\Facades\DB;

use App\Models\Group;
use App\Models\GroupPrivilege;

class GroupCreateOrUpdateAction 
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
	 * Handles creating or updating of Group
	 */
	
	public function execute($request, $id = null)
	{
		$request['see_message'] = $request->filled('see_message');
		$request['write_post'] = $request->filled('write_post');
		$request['send_post'] = $request->filled('send_post');
		$request['authorized_power'] = $request->filled('authorized_power');
		$request['can_sell_open'] = $request->filled('can_sell_open');

		DB::beginTransaction();
			if(!$id) {
				$this->group = $this->group->create($request->all());
				$privileges = GroupPrivilege::get();

				foreach ($privileges as $key => $privilege) {
					$this->group->privileges()->attach($privilege->id);
				}
				
			} else {
				$this->group = Group::withTrashed()->findOrFail($id);
				$this->group->update($request->all());
			}
		DB::commit();

		return $this->group;
	}
}