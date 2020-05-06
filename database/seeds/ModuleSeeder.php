<?php

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_modules')
            ->insert([
                'module_name' => 'Dasbor',
                'module_url' => 'home',
                'module_icon' => 'ni ni-tv-2',
            ]);

        DB::table('table_modules')
            ->insert([
                'module_name' => 'Acara',
                'module_url' => 'events',
                'module_icon' => 'ni ni-calendar-grid-58',
            ]);

        DB::table('table_modules')
            ->insert([
                'module_name' => 'Daftar Pendaftar',
                'module_url' => 'registrant',
                'module_icon' => 'ni ni-bullet-list-67',
            ]);

        DB::table('table_modules')
            ->insert([
                'module_name' => 'Daftar Hadir',
                'module_url' => 'attendance',
                'module_icon' => 'ni ni-single-copy-04',
            ]);

        DB::table('table_modules')
            ->insert([
                'module_name' => 'Pengguna',
                'module_url' => 'user',
                'module_icon' => 'ni ni-circle-08',
            ]);

        DB::table('table_modules')
            ->insert([
                'module_name' => 'Acara',
                'module_url' => 'user-event',
                'module_icon' => 'ni ni-circle-08',
            ]);
    }
}
