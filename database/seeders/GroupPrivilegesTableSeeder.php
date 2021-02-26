<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\GroupPrivilege;

class GroupPrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupPrivilege::truncate();


        $privileges = array(
            array('id' => '1','menu' => 'Welcome'),
            array('id' => '2','menu' => 'Management'),
            array('id' => '3','menu' => 'Modules'),
            array('id' => '4','menu' => 'Support'),
            array('id' => '5','menu' => 'Reports'),
            array('id' => '6','menu' => 'Help Desk'),
        );

        foreach ($privileges as $privilege) {
        	$item = GroupPrivilege::create($privilege);
        }
    }
}
