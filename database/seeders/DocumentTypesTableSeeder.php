<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\DocumentType;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
            array('name' => 'Ticket'),
            array('name' => 'Route Ticket'),
            array('name' => 'Ticket Courtesy'),
            array('name' => 'Contract Ticket'),
            array('name' => 'Voucher Baggage Excess'),
            array('name' => 'Invoice'),
            array('name' => 'Receipt'),
            array('name' => 'Income Voucher'),
            array('name' => 'Expense Voucher'),
            array('name' => 'Waybill'),
            array('name' => 'Passenger Manifest'),
            array('name' => 'Baggage Manifest'),
            array('name' => 'Cheque de Pago'),
            array('name' => 'Orden de Translado'),
        );

        foreach ($types as $type) {
        	$item = DocumentType::create($type);
        }
    }
}
