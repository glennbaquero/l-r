<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\TerminalCollection;
use App\Http\Fetch\TerminalFetch;

use App\Models\ConfigurationTerminal;
use App\Models\Office;
use App\Models\WebBrowser;
use App\Models\OperatingSystem;
use App\Models\PrinterBrand;

class TerminalController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TerminalFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\TerminalMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.configuration-terminal.index', [
            'headers' => TerminalCollection::$headers,
            'searches' => TerminalCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new TerminalCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $offices = Office::get();
        $webBrowsers = WebBrowser::get();
        $operatingSystems = OperatingSystem::get();
        $printerBrands = PrinterBrand::with('printers')->get();
        return view('pages.configuration-terminal.create', [
            'offices' => $offices,
            'webBrowsers' => $webBrowsers,
            'operatingSystems' => $operatingSystems,
            'printerBrands' => $printerBrands,
        ]);
    }

    /**
     * Show Terminals view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $terminal = ConfigurationTerminal::withTrashed()->findOrFail($id);
        $offices = Office::get();
        $webBrowsers = WebBrowser::get();
        $operatingSystems = OperatingSystem::get();
        $printerBrands = PrinterBrand::with('printers')->get();

        return view('pages.configuration-terminal.show', [
            'terminal' => $terminal,
            'offices' => $offices,
            'webBrowsers' => $webBrowsers,
            'operatingSystems' => $operatingSystems,
            'printerBrands' => $printerBrands,
        ]);
    }

}
