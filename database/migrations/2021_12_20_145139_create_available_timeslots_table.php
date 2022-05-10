<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableTimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_timeslots', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('medical_staff_id');
            $table->date('availDate');
            $table->integer('blockNumber');
            $table->integer('status');

            $table->index('medical_staff_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_timeslots');
    }
}
