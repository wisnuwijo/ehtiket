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
            $table->string('event_slug')->unique();
            $table->string('event_name');
            $table->string('event_date');
            $table->string('event_start');
            $table->string('event_finish');
            $table->string('event_place');
            $table->string('event_bank_name')->nullable();
            $table->string('event_bank_owner')->nullable();
            $table->integer('event_bank_number')->nullable();
            $table->string('event_latitude')->nullable();
            $table->string('event_longitude')->nullable();
            $table->string('event_category');
            $table->string('event_logo')->nullable();
            $table->string('event_background')->nullable();
            // value : paid OR free
            $table->string('event_subscription')->default('paid');
            $table->text('event_info')->nullable();
            $table->text('attachments')->nullable();
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
