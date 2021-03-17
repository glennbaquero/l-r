<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupPrivilege;
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
        // Group::truncate();
        // GroupPrivilege::truncate();

        // $groups = [
        //     'Administrator', 'Agent', 'Driver', 'Supervisor', 'Dispatcher'
        // ];

        $groups = array(
                array('name' => 'Administrator'),
                array('name' => 'Agent', 'has_commission' => true),
                array('name' => 'Driver'),
                array('name' => 'Supervisor'),
                array('name' => 'Dispatcher'),
        );

        $privileges = array(
            array('menu' => 'Welcome'),
            array('menu' => 'Management'),
            array('menu' => 'Modules'),
            array('menu' => 'Support'),
            array('menu' => 'Reports'),
            array('menu' => 'Help Desk'),
        );

        $group_ids = [];

        
        foreach($groups as $group) {
            $group = Group::create($group);

            array_push($group_ids, [
                'group_id' => $group->id,
                'selected' => rand(0,1)
            ]);

        }

        foreach ($privileges as $privilege) {
            $item = GroupPrivilege::create($privilege);
            $item->groups()->sync($group_ids);
        }
        
    }
}
