<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEventSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_event_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('event_id');
            $table->integer('max_ticket_per_transaction')->default(1);
            // value : individu OR team OR hybrid
            $table->string('participant_type')->nullable();
            $table->integer('min_team_member')->nullable();
            $table->integer('max_team_member')->nullable();
            // value : true : false
            $table->string('point_team_lead')->nullable();
            $table->integer('registration_cost')->nullable();
            $table->text('registration_form')->nullable();
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
        Schema::dropIfExists('table_event_setting');
    }
}
