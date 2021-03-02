<?php

namespace App\Actions\Terminals;

use Illuminate\Support\Facades\DB;

use App\Models\ConfigurationTerminal;

class TerminalCreateOrUpdateAction 
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
	 * Handles creating or updating of terminal
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->terminal = $this->terminal->create($request->all());
			} else {
				$this->terminal = ConfigurationTerminal::withTrashed()->findOrFail($id);
				$this->terminal->update($request->all());
			}
		DB::commit();


		return $this->terminal;
	}
}