<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(TerminalTableSeeder::class);
        $this->call(OfficeTypeTableSeeder::class);
        $this->call(OfficeTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
