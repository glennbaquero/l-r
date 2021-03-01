<?php

namespace App\Actions\GroupEmails;

use Illuminate\Support\Facades\DB;

use App\Models\GroupEmail;

class GroupEmailCreateOrUpdateAction 
{
	protected $group;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(GroupEmail $group)
	{
		$this->group = $group;
	}

	/**
	 * Handles creating or updating of GroupEmail
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->group = $this->group->create($request->all());
			} else {
				$this->group = Group::withTrashed()->findOrFail($id);
				$this->group->update($request->all());
			}
		DB::commit();

		return $this->group;
	}
}