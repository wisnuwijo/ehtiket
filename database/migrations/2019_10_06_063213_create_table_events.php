<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institution_id');
            $table->string('event_name');
            $table->string('event_date');
            $table->string('event_start');
            $table->string('event_finish');
            $table->string('event_place');
            $table->text('event_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_events');
    }
}
