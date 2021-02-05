<?php

namespace Database\Seeders;

use App\Models\OfficeType;
use Illuminate\Database\Seeder;

class OfficeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Agencia',
                'code' => 'agencia',
            ],
            [
                'name' => 'Terminal / Punto de Venta',
                'code' => 'punto_venta',
            ],
            [
                'name' => 'Bus',
                'code' => 'bus'
            ]
        ];

        foreach($types as $type) {
            OfficeType::create($type);
        }
    }
}
