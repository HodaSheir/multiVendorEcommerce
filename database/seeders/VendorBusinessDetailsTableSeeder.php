<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorBusinessDetails;

class VendorBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBusinessRecords = [
            ['id'=>1,'vendor_id'=>1,'shop_name'=>'John Electronics store','shop_address'=>'1234-SCF','shop_city'=>'New Delhi','shop_state'=>'Delhi'
            ,'shop_country'=>'India','shop_pincode'=>'11002','shop_mobile' => '97821445000', 'shop_website'=>'www.johnshop.com',
            'shop_email'=>'john@vendor.com','address_proof'=>'Passport','address_proof_image'=>'test.jpg',
            'business_license_number' => '232435','gst_number'=>'132423', 'pan_number'=>'5454524','created_at' => now(),'updated_at' => now()],
            ['id'=>2,'vendor_id'=>2,'shop_name'=>'Lara Toys Store','shop_address'=>'234-DFS','shop_city'=>'New Delhi','shop_state'=>'Delhi'
            ,'shop_country'=>'India','shop_pincode'=>'11003','shop_mobile' => '789414044880', 'shop_website'=>'www.larashop.com',
            'shop_email'=>'lara@vendor.com','address_proof'=>'Passport','address_proof_image'=>'test.jpg',
            'business_license_number' => '2324680','gst_number'=>'42546853', 'pan_number'=>'24354646','created_at' => now(),'updated_at' => now()]
        ];
        VendorBusinessDetails::insert($vendorBusinessRecords);
    }
}
