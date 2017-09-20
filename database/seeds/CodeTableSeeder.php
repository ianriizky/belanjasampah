<?php

use Illuminate\Database\Seeder;

class CodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('codes')->insert([
        	'name'         	=> 'Debit',
            'description'  	=> 'menabung sampah ke bank sampah',
            'type'			=> '+',
            'active'		=> true,
        ]);
        DB::table('codes')->insert([
        	'name'         	=> 'Kredit',
            'description'  	=> 'menarik tunai dari bank sampah',
            'type'			=> '-',
            'active'		=> true,
        ]);
        DB::table('codes')->insert([
        	'name'         	=> 'Belanja',
            'description'  	=> 'berbelanja di koperasi serba usaha',
            'type'			=> '-',
            'active'		=> true,
        ]);
    }
}
