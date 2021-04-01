<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Service;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
        	'name' => 'Service name',
        	'description' => 'Service Description'
        ]);
    }
}
