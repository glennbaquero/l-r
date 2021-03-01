<?php

namespace App\Actions\Users;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserDeleteAction 
{
	protected $user;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Handles archiving of user
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->user = User::withTrashed()->findOrFail($id);
				$this->user->delete();
		DB::commit();


		return true;
	}
}