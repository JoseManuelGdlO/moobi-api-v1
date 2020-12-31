<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prospection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('prospection');
        Schema::create('prospection', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('address');
            $table->string('state');
            $table->string('name_business');
            $table->string('description_business');
            $table->string('media_type');
            $table->date('creation_date');
            $table->string('available_time');
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
