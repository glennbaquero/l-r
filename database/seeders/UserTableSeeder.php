<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname' => 'Jerome',
                'lastname' => 'Embate',
                'email' => 'jerome@diversifiedrobotic.com',
                'username' => 'jerome',
                'password' => \Hash::make('password'),
                'office_id' => 2,
                'group_id' => 1,
                'address_line_1' => 'address_line_1',
                'city' => 'city',
                'country' => 'country',
                'zip_code' => 'zip_code',
                'phone_number' => 'phone_number',
                'phone_number' => '0000000',
                'cellphone_number' => '0000000',
            ],
            [
                'firstname' => 'Joel',
                'lastname' => 'Lopez',
                'email' => 'joel.lopez',
                'username' => 'joeljr',
                'password' => \Hash::make('password'),
                'office_id' => 2,
                'group_id' => 1,
                'address_line_1' => 'address_line_1',
                'city' => 'city',
                'country' => 'country',
                'zip_code' => 'zip_code',
                'phone_number' => 'phone_number',
                'phone_number' => '0000000',
                'cellphone_number' => '0000000',
            ]
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}
