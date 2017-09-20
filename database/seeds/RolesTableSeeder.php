<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        //roles
        DB::table('roles')->insert([
        	'name'         => 'admin_sistem',
            'display_name' => 'Admin Sistem',
            'description'  => 'mengelola sistem informasi secara keseluruhan (developer)',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ]);
        DB::table('roles')->insert([
        	'name'         => 'admin_koperasi',
            'display_name' => 'Koperasi Serba usaha',
            'description'  => 'mengelola barang dan transaksi belanja yang ada di sistem informasi',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ]);
        DB::table('roles')->insert([
        	'name'         => 'admin_bank',
            'display_name' => 'Bank Sampah',
            'description'  => 'mengelola nasabah dan transaksi-transaksi perbankan yang ada di sistem informasi',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ]);
        DB::table('roles')->insert([
        	'name'         => 'nasabah',
            'display_name' => 'Nasabah',
            'description'  => 'melakukan transaksi belanja dan perbankan di sistem informasi',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ]);
    }
}
