<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	'name'         	=> 'Makanan',
            'description'  	=> 'kebutuhan makanan sehari-hari',
            'unit'			=> 'pcs',
            'active'		=> true,
        ]);
        DB::table('categories')->insert([
        	'name'         	=> 'Minuman',
            'description'  	=> 'kebutuhan minuman sehari-hari',
            'unit'			=> 'pcs',
            'active'		=> true,
        ]);
        DB::table('categories')->insert([
        	'name'         	=> 'Alat tulis',
            'description'  	=> 'kebutuhan alat tulis kantor dan yang semacamanya',
            'unit'			=> 'pcs',
            'active'		=> true,
        ]);
    }
}
