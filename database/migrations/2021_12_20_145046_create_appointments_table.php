<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('medical_staff_id');
            $table->unsignedBigInteger('treatment_id');
            $table->unsignedBigInteger('department_id');
            $table->date('appDate');
            $table->string('appTime');
            $table->longText('memo')->nullable();
            $table->string('status');

            $table->index('patient_id');
            $table->index('medical_staff_id');
            $table->index('treatment_id');
            $table->index('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
