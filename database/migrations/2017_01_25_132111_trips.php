<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Trips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // trip table
    Schema::create('trips', function(Blueprint $table)
    {
      $table->increments('id');
      $table -> integer('driver_id') -> unsigned() -> default(0);
      $table->foreign('driver_id')
          ->references('id')->on('users')
          ->onDelete('cascade');
      $table->string('title');
      $table->text('body');
      $table->string('slug')->unique();
      $table->boolean('active');
      $table->timestamps();
      $table->string('to')->unique();
      $table->string('from');
      $table->date('date');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop blog table
    Schema::drop('trips');
    }
}
