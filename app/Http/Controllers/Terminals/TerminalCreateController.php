<?php

namespace App\Http\Controllers\Terminals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Terminals\TerminalStoreRequest;

use App\Actions\Terminals\TerminalCreateOrUpdateAction;
use Session;

class TerminalCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(TerminalCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(TerminalStoreRequest $request)
    {
    	$terminal = $this->action->execute($request);
        Session::flash('success', 'Terminal successfully created!');
        return redirect()->route('terminal.show', $terminal->id);
    }
}
