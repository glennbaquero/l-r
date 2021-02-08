<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'Administrator', 'Agent', 'Driver', 'Supervisor', 'Dispatcher'
        ];

        foreach($groups as $group) {
            Group::create([
                'name' => $group
            ]);
        }
    }
}
