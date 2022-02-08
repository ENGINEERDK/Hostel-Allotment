<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudenthostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studenthostels', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('year');
            $table->Integer('hostel1');            
            $table->Integer('hostel2')->default('0');
            $table->Integer('hostel3')->default('0');
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
        Schema::dropIfExists('studenthostels');
    }
}
