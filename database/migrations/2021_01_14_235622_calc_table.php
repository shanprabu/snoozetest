<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CalcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculated', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_zone');
            $table->string('to_zone');
            $table->dateTime('despatched');
            $table->dateTime('delivered');
            $table->integer('avgdays');
            $table->integer('actualdays');
            $table->integer('estimatedays');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculated');
    }
}
