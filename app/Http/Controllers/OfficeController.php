<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Http\Fetch\OfficeFetch;
use App\Http\Resources\OfficeCollection;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(OfficeFetch $fetch)
    {
        $this->fetch = $fetch;
    }

    /**
     * Show office index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.office.index', [
            'headers' => OfficeCollection::$headers,
            'searches' => OfficeCollection::$searches,
        ]);
    }

    /**
     * Fetch all offices
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new OfficeCollection($this->fetch->execute(request()->input()));
    }
}
