<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\WebBrowser;
use App\Models\OperatingSystem;

class BrowserAndOSTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$browsers = [
    		[
    			'name' => 'Mozilla Firefox'
    		],
    		[
    			'name' => 'Chrome'
    		],
    		[
    			'name' => 'Opera'
    		],
    		[
    			'name' => 'Safari'
    		],
    		[
    			'name' => 'Internet Explorer'
    		],
    	];

    	$os = [
    		[
    			'name' => 'General'
    		],
    		[
    			'name' => 'Windows 7'
    		],
    		[
    			'name' => 'Windows 8'
    		],
    		[
    			'name' => 'Windows Vista'
    		],
    		[
    			'name' => 'Windows XP'
    		],
    	];

    	foreach ($browsers as $browser) {
	        WebBrowser::create($browser);
    	}

    	foreach ($os as $operating_system) {
	        OperatingSystem::create($operating_system);
    	}
    }
}
