<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Events extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('events');
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_event');
            $table->string('description');
            $table->date('event_date');
            $table->date('event_delivery');
            $table->date('event_recolected');
            $table->string('hour_delivery');
            $table->string('hour_recolected');
            $table->string('hour_date');
            $table->string('aux_phone_number');
            $table->string('references');
            $table->string('status');
            $table->string('comment');
            $table->integer('fk_business_id')
            ->foreignId('id')
            ->references('id')
            ->on('business');
            $table->integer('fk_price_id')
            ->foreignId('id')
            ->references('id')
            ->on('event_price');
            $table->integer('fk_discount_id')
            ->foreignId('id')
            ->references('id')
            ->on('discount');
            $table->integer('fk_client_id')
            ->foreignId('id')
            ->references('id')
            ->on('client');
            $table->integer('fk_address_id')
            ->foreignId('id') // UNSIGNED BIG INT
            ->references('id')
            ->on('address');
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
