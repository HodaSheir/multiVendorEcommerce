<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id'=>1,'name'=>'Super Admin','type'=>'superadmin','email'=>'super@admin.com',
            'mobile'=>'980000000','vendor_id' => 0 , 'password' => '$2y$10$0TcONKoRoDK7fg7L/S8Cs.WSCCoC12RH8TAQFS3nVSJle5z2Kx9Nu' ,
             'image' => '','status'=>1,'created_at' => now(),'updated_at' => now()],
            ['id'=>2,'name'=>'Admin','type'=>'admin','email'=>'admin@admin.com',
            'mobile'=>'980000000','vendor_id' => 0 , 'password' => '$2y$10$0TcONKoRoDK7fg7L/S8Cs.WSCCoC12RH8TAQFS3nVSJle5z2Kx9Nu' , 
            'image' => '','created_at' => now(),'updated_at' => now(), 'status' =>1]
        ];
        Admin::insert($adminRecords);
    }
}
