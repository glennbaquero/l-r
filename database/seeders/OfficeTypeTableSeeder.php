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
                'has_added_field' => true,
                'has_main_agency' => true,
            ],
            [
                'name' => 'Super Agencia',
                'code' => 'super_agencia',
                'has_added_field' => true,
            ],
            [
                'name' => 'Oficina - Administrative',
                'code' => 'oficina',
            ],
            [
                'name' => 'Terminal / Punto de Venta',
                'code' => 'punto_venta',
            ],
            [
                'name' => 'Bus',
                'code' => 'bus'
            ],
            [
                'name' => 'Ruta',
                'code' => 'ruta'
            ]
        ];

        foreach($types as $type) {
            OfficeType::create($type);
        }
    }
}
