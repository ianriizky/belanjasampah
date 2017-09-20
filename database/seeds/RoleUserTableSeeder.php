<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
        	'user_id'  		=> 'adminsistem',
            'role_id'		=> '1',
        ]);
        // DB::table('role_user')->insert([
        // 	'user_id'  		=> 'adminkoperasi',
        //     'role_id'		=> '2',
        // ]);
        // DB::table('role_user')->insert([
        // 	'user_id'  		=> 'pegawaibank',
        //     'role_id'		=> '3',
        // ]);
        // DB::table('role_user')->insert([
        // 	'user_id'  		=> 'nasabah',
        //     'role_id'		=> '4',
        // ]);
    }
}
