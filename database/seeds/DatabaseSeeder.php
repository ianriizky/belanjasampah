<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CodeTableSeeder::class);
        // $this->call(KoperasisTableSeeder::class);
    }
}
