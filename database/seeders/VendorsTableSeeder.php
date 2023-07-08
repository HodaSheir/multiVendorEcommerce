<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorsRecords = [
            ['id'=>1,'name'=>'John','address'=>'CP-112','city'=>'New Delhi','state'=>'Delhi','country'=>'India'
            ,'pincode'=>'110001','mobile'=>'97000000000','email' => 'venor@vendor.com', 'status'=>0,'created_at' => now(),'updated_at' => now()],
            ['id'=>2,'name'=>'Lara','address'=>'CP-113','city'=>'New Delhi','state'=>'Delhi','country'=>'India'
            ,'pincode'=>'110002','mobile'=>'980000000','email' => 'vendor@vendor.com', 'status'=>0,'created_at' => now(),'updated_at' => now()]
        ];
        Vendor::insert($vendorsRecords);
    }
}
