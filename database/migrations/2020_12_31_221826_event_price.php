<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('event_price');
        Schema::create('event_price', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total');
            $table->integer('tax');
            $table->smallInteger('type');
            $table->string('description');
            $table->integer('pay_numbers');
            $table->decimal('initial_pay');
            $table->decimal('total_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
