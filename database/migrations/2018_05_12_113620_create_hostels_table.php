<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('hostel_id');
            $table->Integer('category');
            $table->string('hostelname', 100);
            $table->Integer('allotedto')->nullable();
            $table->timestamps();

            $table->foreign('hostel_id')->references('hostel1')->on('studenthostels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostels');
    }
}
