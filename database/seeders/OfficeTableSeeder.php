<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            [
                'name' => 'FDN - Huntington Pk.',
                'code' => bin2hex(random_bytes(3)),
                'phone_number' => '(323) 587-5233',
                'office_type_id' => 2,
                'office_type_name' => 'Terminal / Punto de Venta',
                'terminal_id' => 2,
                'terminal_name' => 'FDN - Huntington Pk.'
            ]
        ];

        foreach($offices as $office) {
            Office::create($office);
        }
    }
}
