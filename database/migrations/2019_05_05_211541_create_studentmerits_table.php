<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentmeritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentmerits', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('regno')->unsigned();
            $table->Integer('year');
            $table->decimal('academics', 6, 2)->unsigned();
            $table->decimal('attendance', 6, 2)->unsigned();
            $table->decimal('merit', 7, 2)->unsigned();
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
        Schema::dropIfExists('studentmerits');
    }
}
