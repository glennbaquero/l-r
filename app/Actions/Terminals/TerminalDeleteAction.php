<?php

namespace App\Actions\Terminals;

use Illuminate\Support\Facades\DB;

use App\Models\ConfigurationTerminal;

class TerminalDeleteAction 
{
	protected $terminal;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(ConfigurationTerminal $terminal)
	{
		$this->terminal = $terminal;
	}

	/**
	 * Handles archiving of terminal
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->terminal = ConfigurationTerminal::withTrashed()->findOrFail($id);
				$this->terminal->delete();
		DB::commit();


		return true;
	}
}