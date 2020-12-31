<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Discount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('discount');
        Schema::create('discount', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('type');
            $table->string('sku');
            $table->integer('percentege');
            $table->decimal('direct_disc');
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
