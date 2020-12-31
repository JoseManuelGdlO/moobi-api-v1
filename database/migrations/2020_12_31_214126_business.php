<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Business extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('business');
        Schema::create('business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state');
            $table->string('address');
            $table->string('phone_number');
            $table->string('image_logo');
            $table->string('country');
            $table->string('description');
            $table->date('creation_date');
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
