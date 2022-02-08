<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->bigInteger('regno')->unique()->unsigned();
            $table->Integer('rollno')->unsigned();
            $table->string('name', 100);
            $table->Integer('year');
            $table->Integer('branch');
            $table->decimal('marks', 4, 2)->unsigned();
            $table->Integer('accm_for');

            $table->Integer('hostel_pref1');
            $table->Integer('hostel_pref2')->nullable();
            $table->Integer('hostel_pref3')->nullable();
            $table->Integer('hostel_pref4')->nullable();

            $table->Integer('room_pref1');
            $table->Integer('room_pref2');
            $table->Integer('room_pref3');
            $table->Integer('room_pref4');

            $table->Integer('floor_pref1');
            $table->Integer('floor_pref2');
            $table->Integer('floor_pref3');
            $table->Integer('floor_pref4');

            $table->bigInteger('mate1')->unsigned()->nullable();
            $table->bigInteger('mate2')->unsigned()->nullable();
            $table->bigInteger('mate3')->unsigned()->nullable();
            
            $table->Integer('status')->default('0');
            $table->Integer('meritin')->default('0');
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
        Schema::dropIfExists('applications');
    }
}
