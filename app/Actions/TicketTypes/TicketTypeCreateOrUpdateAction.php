<?php

namespace App\Actions\TicketTypes;

use Illuminate\Support\Facades\DB;

use App\Models\TicketType;

class TicketTypeCreateOrUpdateAction 
{
	protected $ticket_type;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(TicketType $ticket_type)
	{
		$this->ticket_type = $ticket_type;
	}

	/**
	 * Handles creating or updating of TicketType
	 */
	
	public function execute($request, $id = null)
	{
		$request['available_sale_web'] = $request->filled('available_sale_web');
		$request['available_to_coupon'] = $request->filled('available_to_coupon');
		$request['discount_type'] = $request->filled('discount_type') ? 'Decimal' : 'Percent';
		$request['return_discount'] = $request->filled('return_discount');
		$request['required_authorization'] = $request->filled('required_authorization');
		$request['required_email'] = $request->filled('required_email');
		$request['required_telephone'] = $request->filled('required_telephone');
		$request['show_message'] = $request->filled('show_message');

		$request['selectedIds'] = json_decode($request->selectedIds);
		
		DB::beginTransaction();
			if(!$id) {
				$request['office_id'] = auth()->user()->office->id;
				$request['created_by'] = auth()->user()->id;
				$this->ticket_type = $this->ticket_type->create($request->except(['selectedIds']));
			} else {
				$request['edited_by'] = auth()->user()->id;
				$this->ticket_type = TicketType::withTrashed()->findOrFail($id);
				$this->ticket_type->update($request->except(['selectedIds']));
			}

			$this->ticket_type->dependencies()->sync($request->selectedIds);
		DB::commit();

		return $this->ticket_type;
	}
}