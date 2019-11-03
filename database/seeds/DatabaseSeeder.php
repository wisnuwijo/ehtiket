<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(RoleAccessSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(InstitutionSeeder::class);
    }
}
