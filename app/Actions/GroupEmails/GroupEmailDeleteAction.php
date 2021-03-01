<?php

namespace App\Actions\GroupEmails;

use Illuminate\Support\Facades\DB;

use App\Models\GroupEmail;

class GroupEmailDeleteAction 
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
	 * Handles archiving of Group Email
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->group = GroupEmail::withTrashed()->findOrFail($id);
				$this->group->delete();
		DB::commit();


		return true;
	}
}