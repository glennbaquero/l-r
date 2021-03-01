<?php

namespace App\Actions\TicketTypes;

use Illuminate\Support\Facades\DB;

use App\Models\TicketType;

class TicketTypeDeleteAction 
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
	 * Handles archiving of TicketType
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->ticket_type = TicketType::withTrashed()->findOrFail($id);
				$this->ticket_type->delete();
		DB::commit();


		return true;
	}
}