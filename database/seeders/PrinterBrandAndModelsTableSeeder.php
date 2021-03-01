<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\PrinterBrand;
use App\Models\PrinterModel;

class PrinterBrandAndModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
        	[
        		'name' => 'Canon',

        		'models' => []
        	],
        	[
        		'name' => 'EPSON',

        		'models' => []
        	],
        	[
        		'name' => 'GENERAL',

        		'models' => [
        			[
        				'name' => 'GENERAL'
        			],
        			[
        				'name' => 'GENERAL TERMAL'
        			],
        		]
        	],
        	[
        		'name' => 'HP',

        		'models' => []
        	],
        	[
        		'name' => 'Lexmark',

        		'models' => []
        	],
        	[
        		'name' => 'Panasonic',

        		'models' => []
        	],
        	[
        		'name' => 'Sony',

        		'models' => []
        	],
        	[
        		'name' => 'Xerox',

        		'models' => []
        	],
        ];


        foreach ($items as $item) {
        	$brand = PrinterBrand::create([
        		'name' => $item['name']
        	]);

        	foreach ($item['models'] as $model) {
        		$brand->printerModels()->create([
        			'name' => $model['name']
        		]);
        	}
        }
    }
}
