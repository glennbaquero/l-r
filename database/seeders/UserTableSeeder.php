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
            ]
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}
