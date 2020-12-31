<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_admin');
            $table->boolean('is_delete');
            $table->date('creation_date');
            $table->integer('fk_business_id')
            ->foreignId('id') // UNSIGNED BIG INT
            ->references('id')
            ->on('business');
            $table->integer('fk_rol_id')
            ->foreignId('id') // UNSIGNED BIG INT
            ->references('id')
            ->on('roles');
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
