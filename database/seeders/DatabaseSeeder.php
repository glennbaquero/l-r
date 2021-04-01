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
        $this->call(CitiesTableSeeder::class);
        $this->call(TerminalTableSeeder::class);
        $this->call(OfficeTypeTableSeeder::class);
        $this->call(OfficeTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(USStatesTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(DependenciesTableSeeder::class);
        $this->call(PrinterBrandAndModelsTableSeeder::class);
        $this->call(BrowserAndOSTableSeeder::class);
        $this->call(DriverTableSeeder::class);
        $this->call(PriceTableSeeder::class);
        $this->call(BusTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(TripTableSeeder::class);

        $this->call(PassengerTableSeeder::class);
        $this->call(TicketTableSeeder::class);
    }
}
