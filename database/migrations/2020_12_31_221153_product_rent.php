<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductRent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('product_rent');
        Schema::create('product_rent', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price');
            $table->integer('quantity_rent');
            $table->integer('fk_inventary_id')
            ->foreignId('id') // UNSIGNED BIG INT
            ->references('id')
            ->on('inventary');
            $table->integer('fk_event_id')
            ->foreignId('id') // UNSIGNED BIG INT
            ->references('id')
            ->on('events');
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
