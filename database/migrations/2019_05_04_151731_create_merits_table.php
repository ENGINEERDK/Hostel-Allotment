<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merits', function (Blueprint $table) {
            $table->increments('id');
            
            $table->Integer('regno')->unsigned();
            $table->string('name');
            $table->decimal('academics', 4, 2)->unsigned();
            $table->decimal('attendance', 4, 2)->unsigned();
            $table->decimal('merit', 5, 2)->unsigned();

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
        Schema::dropIfExists('merits');
    }
}
