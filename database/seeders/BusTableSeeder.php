<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Cell;
use App\Models\Bus;
use App\Models\BusModel;
use App\Models\BusModelRow;
use App\Models\BusModelColumn;

class BusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Cell::create([
            'name' => 'Available Seat',
            'icon' => 'seat_available.png',
            'image_path' => 'icons/seat_available.png'
        ]);


        $models = [
            [
                'name' => 'Bus Model #1',
                'default_cell_id' => 1,
                'rows' => 5,
                'columns' => 8,
                'seats' => 2,
                'floors' => 1,
            ],
            [
                'name' => 'Bus Model #2',
                'default_cell_id' => 1,
                'rows' => 6,
                'columns' => 6,
                'seats' => 2,
                'floors' => 1,
            ],
            [
                'name' => 'Bus Model #3',
                'default_cell_id' => 1,
                'rows' => 6,
                'columns' => 6,
                'seats' => 2,
                'floors' => 1,
            ],
        ];

        foreach ($models as $model) {
            $bus_model = BusModel::create($model);
            for($row = 0; $row < $model['rows']; $row++) {
                $bus_row = BusModelRow::create(['bus_model_id' => $bus_model->id]);

                for($column = 0; $column < $model['columns']; $column++) {
                    BusModelColumn::create([
                        'bus_model_row_id' => $bus_row->id,
                        'image_path' => url('icons/seat_available.png'),
                        'label' => $column,
                        'orientation' => 360
                    ]);
                }
            }
        }

        $buses = [
        	[
        		'name' => 'Bus 1',
                'plate' => 'Bus 1 Plate Number',
                'bus_model_id' => 1,
        	],
        	[
        		'name' => 'Bus 2',
                'plate' => 'Bus 2 Plate Number',
                'bus_model_id' => 2,
        	],
        	[
        		'name' => 'Bus 3',
                'plate' => 'Bus 3 Plate Number',
                'bus_model_id' => 3,
        	],
        ];


        foreach ($buses as $bus) {
        	Bus::create($bus);
        }
    }
}
