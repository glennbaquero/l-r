<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Route;
use App\Models\Stop;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\City;
use App\Models\Service;

use Carbon\Carbon;

class TripTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [

        	[
        		'name' => 'Route #1',
        		'alias' => 'Route 1 (Alias)',
        		'report_alias' => 'Route 1 (Report Alias)',
        		'departure_id' => 1,
        		'trip_length' => '00:06:00',
        		'wait_time' => '00:06:00',
        		'distance' => 1,

        		'stops' => [
        			[
		        		'trip_length' => '00:06:00',
		        		'wait_time' => '00:06:00',
		        		'distance' => 1,
		        		'arrival_id' => 2,
		        		'departure_id' => 1,

        			]
        		],

        		'trips' => [
        			[
        				'date' => Carbon::now()->addDays(15)->format('Y-m-d'),
        				'time' => now(),
        				'service_id' => Service::first()->id,
        				'bus_id' => Bus::first()->id,
        				'driver_id' => Driver::first()->id,
        			]
        		],
        	],
        	[
        		'name' => 'Route #2',
        		'alias' => 'Route 2 (Alias)',
        		'report_alias' => 'Route 2 (Report Alias)',
        		'departure_id' => 1,
        		'trip_length' => '00:12:00',
        		'wait_time' => '00:12:00',
        		'distance' => 3,

        		'stops' => [
        			[
		        		'trip_length' => '00:04:00',
		        		'wait_time' => '00:04:00',
		        		'distance' => 1,
		        		'arrival_id' => 2,
		        		'departure_id' => 1,
		        		
        			],
        			[
		        		'trip_length' => '00:04:00',
		        		'wait_time' => '00:04:00',
		        		'distance' => 1,
		        		'arrival_id' => 3,
		        		'departure_id' => 2,
		        		
        			],
        			[
		        		'trip_length' => '00:04:00',
		        		'wait_time' => '00:04:00',
		        		'distance' => 1,
		        		'arrival_id' => 4,
		        		'departure_id' => 3,
		        		
        			],
        		],

        		'trips' => [
        			[
        				'date' => Carbon::now()->addDays(15)->format('Y-m-d'),
        				'time' => now(),
        				'service_id' => Service::first()->id,
        				'bus_id' => Bus::first()->id,
        				'driver_id' => Driver::first()->id,
        			]
        		],
        	],
        	[
        		'name' => 'Route #3',
        		'alias' => 'Route 3 (Alias)',
        		'report_alias' => 'Route 3 (Report Alias)',
        		'departure_id' => 1,
        		'trip_length' => '00:06:00',
        		'wait_time' => '00:06:00',
        		'distance' => 1,

        		'stops' => [
        			[
		        		'trip_length' => '00:06:00',
		        		'wait_time' => '00:06:00',
		        		'distance' => 1,
		        		'arrival_id' => 2,
		        		'departure_id' => 1,

        			]
        		],

        		'trips' => [
        			[
        				'date' => Carbon::now()->addDays(15)->format('Y-m-d'),
        				'time' => now(),
        				'service_id' => Service::first()->id,
        				'bus_id' => Bus::first()->id,
        				'driver_id' => Driver::first()->id,
        			]
        		],
        	],
        ];

        foreach ($routes as $route) {
        	$route_created = Route::create([
        		'name' => $route['name'],
        		'alias' => $route['alias'],
        		'report_alias' => $route['report_alias'],
        		'departure_id' => $route['departure_id'],
        		'trip_length' => $route['trip_length'],
        		'wait_time' => $route['wait_time'],
        		'distance' => $route['distance'],
        	]);

        	foreach ($route['stops'] as $stop) {
        		$route_created->stops()->create($stop);
        	}

        	foreach ($route['trips'] as $trip) {
        		Trip::create([
        			'route_id' => $route_created->id,
        			'alias_route' => $route_created->alias,
        			'date' => $trip['date'],
        			'time' => $trip['time'],
        			'service_id' => $trip['service_id'],
        			'bus_id' => $trip['bus_id'],
        			'driver_id' => $trip['driver_id'],
        		]);
        	}
        }
    }
}
