<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->nuallable();
            $table->string('name')->nuallable();
            $table->string('email')->nuallable();
            $table->string('gender')->nuallable();
            $table->string('identifier_type')->nullable();
            $table->string('identifier_file')->nullable();
            $table->string('institution_id')->nullable();
            $table->string('origin_institution')->nullable();
            $table->string('phone')->nuallable();
            $table->string('ticket_type_id')->nuallable();
            $table->string('event_id');
            $table->string('paid')->nuallable();
            $table->string('paid_confirmation')->nuallable();
            $table->string('paid_evidence')->nullable();
            $table->text('custom_form_value')->nullable();
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
        Schema::dropIfExists('table_transaction');
    }
}
