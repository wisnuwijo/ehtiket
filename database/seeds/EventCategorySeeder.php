<?php

use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_event_category')
            ->insert([
                'event_category' => 'Seminar',
                'created_at' => now(),
            ]);

        DB::table('table_event_category')
            ->insert([
                'event_category' => 'Lomba',
                'created_at' => now(),
            ]);
    }
}
