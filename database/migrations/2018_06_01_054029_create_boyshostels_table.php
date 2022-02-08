<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoyshostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boyshostels', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('hostel_id')->unsigned();
            $table->Integer('floor')->unsigned();
            $table->Integer('roomno')->unsigned();
            $table->Integer('roomtype')->unsigned();
            $table->Integer('bedno')->nullable();
            $table->Integer('status')->default('0');
            $table->Integer('reserved')->default('0');
            $table->bigInteger('regno')->unsigned()->nullable();
            $table->string('name', 100)->nullable();
            $table->Integer('year')->nullable();
            $table->Integer('branch')->nullable();
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
        Schema::dropIfExists('boyshostels');
    }
}
