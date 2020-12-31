<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Address extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('address');
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state');
            $table->string('country');
            $table->string('street');
            $table->text('references');
            $table->string('number');
            $table->string('suburb');
            $table->string('int_number');
            $table->integer('fk_client_id') 
            ->foreignId('id')// UNSIGNED BIG INT
            ->references('id')
            ->on('client');
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
