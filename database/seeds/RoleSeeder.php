<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_roles')
            ->insert([
                'role_name' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('table_roles')
            ->insert([
                'role_name' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('table_roles')
            ->insert([
                'role_name' => 'Buyer',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
