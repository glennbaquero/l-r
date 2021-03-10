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
                'name' => 'FDN - Compton',
                'office_no' => bin2hex(random_bytes(3)),
                'phone_number' => '(323) 587-5233',
                'office_type_id' => 2,
                'terminal_id' => 2,
                'departure_city_id' => 1,
                'address_line_1' => '4564 Redlands Avenue',
                'latitude' => 33.8563824,
                'longitude' => -117.2180643,
                'state_name' => 'California',
                'zip' => '92571'
            ],
            [
                'name' => 'FDN - Huntington Pk.',
                'office_no' => bin2hex(random_bytes(3)),
                'phone_number' => '(323) 587-5233',
                'office_type_id' => 2,
                'terminal_id' => 2,
                'departure_city_id' => 1,
                'address_line_1' => '4564 Redlands Avenue',
                'latitude' => 33.8563824,
                'longitude' => -117.2180643,
                'state_name' => 'California',
                'zip' => '92571'

            ],
            [
                'name' => 'FDN - Pasco',
                'office_no' => bin2hex(random_bytes(3)),
                'phone_number' => '(323) 587-5233',
                'office_type_id' => 2,
                'terminal_id' => 2,
                'departure_city_id' => 1,
                'address_line_1' => '4564 Redlands Avenue',
                'latitude' => 33.8563824,
                'longitude' => -117.2180643,
                'state_name' => 'California',
                'zip' => '92571'

            ],
            [
                'name' => 'FDN - San Fernando',
                'office_no' => bin2hex(random_bytes(3)),
                'phone_number' => '(323) 587-5233',
                'office_type_id' => 2,
                'terminal_id' => 2,
                'departure_city_id' => 1,
                'address_line_1' => '4564 Redlands Avenue',
                'latitude' => 33.8563824,
                'longitude' => -117.2180643,
                'state_name' => 'California',
                'zip' => '92571'

            ],
            [
                'name' => 'FDN - San Ysidro',
                'office_no' => bin2hex(random_bytes(3)),
                'phone_number' => '(323) 587-5233',
                'office_type_id' => 2,
                'terminal_id' => 2,
                'departure_city_id' => 1,
                'address_line_1' => '4564 Redlands Avenue',
                'latitude' => 33.8563824,
                'longitude' => -117.2180643,
                'state_name' => 'California',
                'zip' => '92571'

            ],
            [
                'name' => 'FDN - Sunnyside',
                'office_no' => bin2hex(random_bytes(3)),
                'phone_number' => '(323) 587-5233',
                'office_type_id' => 2,
                'terminal_id' => 2,
                'departure_city_id' => 1,
                'address_line_1' => '4564 Redlands Avenue',
                'latitude' => 33.8563824,
                'longitude' => -117.2180643,
                'state_name' => 'California',
                'zip' => '92571'

            ],
            [
                'name' => 'FDN - Yakima',
                'office_no' => bin2hex(random_bytes(3)),
                'phone_number' => '(323) 587-5233',
                'office_type_id' => 2,
                'terminal_id' => 2,
                'departure_city_id' => 1,
                'address_line_1' => '4564 Redlands Avenue',
                'latitude' => 33.8563824,
                'longitude' => -117.2180643,
                'state_name' => 'California',
                'zip' => '92571'

            ]

        ];

        foreach($offices as $office) {
            Office::create($office);
        }
    }
}
