<?php

use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_institution')
            ->insert([
                'institution_name' => 'Dignity Indonesia Technology, LTD',
                'institution_address' => 'Desa Sadang RT4/3 Jekulo Kudus, Jawa Tengah',
                'created_at' => now()
            ]);
    }
}
