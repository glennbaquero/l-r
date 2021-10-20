<?php

namespace App\Http\Controllers;

use App\Http\Fetch\PrinterFetch;
use App\Http\Resources\PrinterCollection;
use Illuminate\Http\Request;

use App\Models\Printer;
use App\Models\PrinterModel;
use App\Models\PrinterBrand;

class PrinterController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(PrinterFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\PrinterMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show Driver index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.printer.index', [
            'headers' => PrinterCollection::$headers,
            'searches' => PrinterCollection::$searches,
        ]);
    }

    /**
     * Fetch all Printers
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new PrinterCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show Drivers create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $brands = PrinterBrand::with('printerModels')->get();
        return view('pages.printer.create', [
            'brands' => $brands
        ]);
    }

    /**
     * Show printer view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $printer = Printer::withTrashed()->find($id);
        $brands = PrinterBrand::with('printerModels')->get();
        return view('pages.printer.show', [
            'printer' => $printer,
            'brands' => $brands
        ]);
    }
}
