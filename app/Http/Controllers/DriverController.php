<?php

namespace App\Http\Controllers;

use App\Http\Fetch\DriverFetch;
use App\Http\Resources\DriverCollection;
use Illuminate\Http\Request;

use App\Models\Driver;
use App\Models\City;

class DriverController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(DriverFetch $fetch)
    {
        $this->fetch = $fetch;
    }

    /**
     * Show Driver index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.driver.index', [
            'headers' => DriverCollection::$headers,
            'searches' => DriverCollection::$searches,
        ]);
    }

    /**
     * Fetch all Drivers
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new DriverCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show Drivers create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $document_types = Driver::getDocumentTypes();
        $staff_types = Driver::getStaffTypes();
        $genders = Driver::getGenderTypes();

        return view('pages.driver.create', [
            'cities' => City::get(),
            'genders' => $genders,
            'document_types' => $document_types,
            'staff_types' => $staff_types,
        ]);
    }

    /**
     * Show driver view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Driver::withTrashed()->find($id);
        $document_types = Driver::getDocumentTypes();
        $staff_types = Driver::getStaffTypes();
        $genders = Driver::getGenderTypes();

        return view('pages.driver.show', [
            'cities' => City::get(),
            
            'genders' => $genders,
            'document_types' => $document_types,
            'staff_types' => $staff_types,

            'driver' => $driver
        ]);
    }
}
