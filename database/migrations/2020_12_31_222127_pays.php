<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pays');
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pay_number');
            $table->integer('pay');
            $table->date('creation_date');
            $table->integer('fk_price_event_id')
            ->foreignId('id') // UNSIGNED BIG INT
            ->references('id')
            ->on('event_price');
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
