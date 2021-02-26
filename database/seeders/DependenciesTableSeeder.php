<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Dependence;

class DependenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dependencies = array(
	        array('name' => 'Child 3-9'),
	        array('name' => 'Adult'),
	        array('name' => 'Senior'),
	    );

	    foreach ($dependencies as $key => $dependence) {
	    	Dependence::create($dependence);
	    }
    }
}
