<?php

use Illuminate\Database\Seeder;

class RoleAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrator
        DB::table('table_roles_access')
            ->insert([
                'role_id' => 1,
                'module_id' => 1,
            ]);
        DB::table('table_roles_access')
            ->insert([
                'role_id' => 1,
                'module_id' => 2,
            ]);
        DB::table('table_roles_access')
            ->insert([
                'role_id' => 1,
                'module_id' => 3,
            ]);
        DB::table('table_roles_access')
            ->insert([
                'role_id' => 1,
                'module_id' => 4,
            ]);
        DB::table('table_roles_access')
            ->insert([
                'role_id' => 1,
                'module_id' => 5,
            ]);

        // User
        DB::table('table_roles_access')
            ->insert([
                'role_id' => 2,
                'module_id' => 1,
            ]);

        // buyer
        DB::table('table_roles_access')
            ->insert([
                'role_id' => 3,
                'module_id' => 1,
            ]);

        DB::table('table_roles_access')
            ->insert([
                'role_id' => 3,
                'module_id' => 6,
            ]);
    }
}
