<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
        	'id'			=> 'adminsistem',
        	'email'			=> 'ian.rizkypratama@gmail.com',
        	'name'			=> 'Septianata Rizky Pratama',
            'address'		=> 'Denpasar, Bali',
            'phone_number'	=> '085738626264',
            'gender'		=> 'male',
            'birth_date'	=> '1996-09-11',
            'password'		=> bcrypt('sistem'),
            'active'        => true,
            'created_at'	=> Carbon\Carbon::now(),
            'updated_at'	=> Carbon\Carbon::now()
        ]);

        // DB::table('users')->insert([
        //     'id'            => 'adminkoperasi',
        //     'email'         => 'ian.rizkypratama@gmail.com',
        //     'name'          => 'Made Ari Sudarma',
        //     'password'      => bcrypt('banksampah'),
        //     'active'        => true,
        //     'created_at'    => Carbon\Carbon::now(),
        //     'updated_at'    => Carbon\Carbon::now()
        // ]);

        // DB::table('users')->insert([
        //     'id'            => 'pegawaibank',
        //     'email'         => 'ian.rizkypratama@gmail.com',
        //     'name'          => 'Ananta Wijaya',
        //     'password'      => bcrypt('banksampah'),
        //     'active'        => true,
        //     'created_at'    => Carbon\Carbon::now(),
        //     'updated_at'    => Carbon\Carbon::now()
        // // ]);

        // DB::table('users')->insert([
        //     'id'            => 'nasabah',
        //     'email'         => 'ian.rizkypratama@gmail.com',
        //     'name'          => 'I Putu Nasabah',
        //     'password'      => bcrypt('banksampah'),
        //     'active'        => true,
        //     'created_at'    => Carbon\Carbon::now(),
        //     'updated_at'    => Carbon\Carbon::now()
        // ]);
    }
}
