<?php

use Illuminate\Database\Seeder;

class KoperasisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 30;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('koperasis')->insert([ //,
                'id' => 'KOP'.($i+1),
                'user_id' => 'adminkoperasi',
                'name' => 'Koperasi '.($i+1),
                'address' => $faker->address,
                'description' => $faker->word,
                'order_number' => $i+1,
                'created_at' => \Carbon\Carbon::now(),
            	'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
