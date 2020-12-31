<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('inventary');
        Schema::create('inventary', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('cost');
            $table->integer('quantity');
            $table->string('description');
            $table->string('sku');
            $table->string('image_url');
            $table->date('ceation_date');
            $table->date('update');
            $table->integer('in_inventary');
            $table->boolean('eliminated');
            $table->integer('fk_business_id')
            ->foreignId('id') // UNSIGNED BIG INT
            ->references('id')
            ->on('business');
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
