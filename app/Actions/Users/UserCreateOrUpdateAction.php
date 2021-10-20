<?php

namespace App\Actions\Users;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Driver;

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
		
		$request['restrict_hours'] = $request->filled('restrict_hours');

		if($request->hasFile('file_path')) {
			$path = $request->file('file_path')->store('users', 'public');
	        $request['image_path'] = $path;
		}

		DB::beginTransaction();
			if(!$id) {

                if($request->filled('auto_create_driver')) {
                	Driver::create([
                		'first_name' => $request->firstname,
						'last_name' => $request->lastname,
						'gender' => $request->gender,
						'phone_number' => $request->phone_number,
						'email' => $request->email,
						'address_line_1' => $request->address_line_1,
						'latitude' => '34.04441',
						'longitude' => '-118.273402',
						'city' => $request->city,
						'document_no' => $request->document_no,
						'commission' => $request->commission,
						'license_type' => $request->license_type,
						'license_no' => $request->license_no,
						'license_expiration_date' => $request->license_expiration_date,
						'last_medical_test_date' => $request->last_medical_test_date,
						'next_medical_test_date' => $request->next_medical_test_date

                	]);
                }

                $request['auto_create_driver'] = $request->filled('auto_create_driver');

				$this->user = $this->user->create($request->except(['file_path', 'document_no', 'commission', 'license_type', 'license_no', 'license_expiration_date', 'last_medical_test_date', 'next_medical_test_date']));
                $broker = $this->user->broker();
                
                $broker->sendResetLink($request->only('email'));

			} else {
				$request['auto_create_driver'] = $request->filled('auto_create_driver');
				$request['status'] = $request->filled('status');
				$this->user = User::withTrashed()->findOrFail($id);
				$this->user->update($request->except(['file_path', 'document_no', 'commission', 'license_type', 'license_no', 'license_expiration_date', 'last_medical_test_date', 'next_medical_test_date']));
			}

		DB::commit();


		return $this->user;
	}
}