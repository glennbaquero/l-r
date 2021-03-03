<?php

namespace App\Actions\Users;

use Illuminate\Support\Facades\DB;

use App\Models\User;

use Storage;

class UserCreateOrUpdateAction 
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
	 * Handles creating or updating of user
	 */
	
	public function execute($request, $id = null)
	{
		$request['gender'] = $request->filled('gender') ? 'Female' : 'Male';
		$request['can_print_ticket'] = $request->filled('can_print_ticket');
		$request['record_sales'] = $request->filled('record_sales');
		$request['auto_create_driver'] = $request->filled('auto_create_driver');
		$request['restrict_hours'] = $request->filled('restrict_hours');

		if($request->hasFile('file_path')) {
			$path = $request->file('file_path')->store('users', 'public');
	        $request['image_path'] = $path;
		}

		DB::beginTransaction();
			if(!$id) {
				$this->user = $this->user->create($request->except(['file_path']));
                $broker = $this->user->broker();
                $broker->sendResetLink($request->only('email'));
			} else {
				$request['status'] = $request->filled('status');
				$this->user = User::withTrashed()->findOrFail($id);
				$this->user->update($request->except(['file_path']));
			}
		DB::commit();


		return $this->user;
	}
}