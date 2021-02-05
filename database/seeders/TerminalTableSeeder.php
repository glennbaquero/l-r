<?php

namespace Database\Seeders;

use App\Models\Terminal;
use Illuminate\Database\Seeder;

class TerminalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terminals = [
            [
                'name' => 'FDN - Compton',
                'operating_system' => 'GENERAL',
                'web_browser' => 'Mozilla Firefox',
                'printer' => 'GENERAL GENERAL_TERMAL - GENTERM'
            ],
            [
                'name' => 'FDN - Huntington Pk.',
                'operating_system' => 'GENERAL',
                'web_browser' => 'Mozilla Firefox',
                'printer' => 'GENERAL GENERAL_TERMAL - GENTERM'
            ],
            [
                'name' => 'FDN - Pasco',
                'operating_system' => 'GENERAL',
                'web_browser' => 'Mozilla Firefox',
                'printer' => 'GENERAL GENERAL_TERMAL - GENTERM'
            ],
            [
                'name' => 'FDN - San Fernando',
                'operating_system' => 'GENERAL',
                'web_browser' => 'Mozilla Firefox',
                'printer' => 'GENERAL GENERAL_TERMAL - GENTERM'
            ],
            [
                'name' => 'FDN - San Ysidro',
                'operating_system' => 'GENERAL',
                'web_browser' => 'Mozilla Firefox',
                'printer' => 'GENERAL GENERAL_TERMAL - GENTERM'
            ],
            [
                'name' => 'FDN - Sunnyside',
                'operating_system' => 'GENERAL',
                'web_browser' => 'Mozilla Firefox',
                'printer' => 'GENERAL GENERAL_TERMAL - GENTERM'
            ],
            [
                'name' => 'FDN - Yakima',
                'operating_system' => 'GENERAL',
                'web_browser' => 'Mozilla Firefox',
                'printer' => 'GENERAL GENERAL_TERMAL - GENTERM'
            ]
        ];

        foreach($terminals as $terminal) {
            Terminal::create($terminal);
        }
    }
}
