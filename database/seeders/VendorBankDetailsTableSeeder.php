<?php

namespace Database\Seeders;

use App\Models\VendorBankDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBankRecords = [
            ['id'=>1,'vendor_id'=>1,'account_holder_name'=>'John Mailor','bank_name'=>'HSBC','bank_ifsc_code'=>'a124',
            'account_number'=>'5454524','created_at' => now(),'updated_at' => now()],
            ['id'=>2,'vendor_id'=>2,'account_holder_name'=>'Lara Emile','bank_name'=>'CIB','bank_ifsc_code'=>'b2345',
            'account_number'=>'5454524','created_at' => now(),'updated_at' => now()]
        ];
        VendorBankDetails::insert($vendorBankRecords);
    }
}
