<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert administrator
        DB::table('users')
            ->insert([
                'name' => 'Administrator',
                'email' => 'administrator@niket.id',
                'email_verified_at' => now(),
                'password' => bcrypt('123123123'),
                'role_id' => 1,
                'gender' => 'M',
                'institution_id' => 1,
                'origin_institution' => '',
                'phone' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        // insert user
        DB::table('users')
            ->insert([
                'name' => 'User',
                'email' => 'user@niket.id',
                'email_verified_at' => now(),
                'password' => bcrypt('123123123'),
                'role_id' => 2,
                'gender' => 'M',
                'institution_id' => 1,
                'origin_institution' => '',
                'phone' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
