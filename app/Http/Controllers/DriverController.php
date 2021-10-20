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
        $this->middleware('App\Http\Middleware\DriverMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show Driver index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::get();
        $types = [];
        foreach ($drivers as $driver) {

            $collection = collect($types);
            if(!$collection->contains($driver->license_type)) {
                array_push($types,$driver->license_type);
            }
        }

        return view('pages.driver.index', [
            'headers' => DriverCollection::$headers,
            'searches' => DriverCollection::$searches,
            'licenseTypes' => $types
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
            'cities' => City::orderby('name', 'asc')->get(),
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
            'cities' => City::orderby('name', 'asc')->get(),
            
            'genders' => $genders,
            'document_types' => $document_types,
            'staff_types' => $staff_types,

            'driver' => $driver
        ]);
    }
}
