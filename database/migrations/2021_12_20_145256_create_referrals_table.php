<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('medical_staff_id')->nullable();
            $table->string('status');
            $table->date('referralDate');
            $table->time('referralTime')->nullable();
            $table->string('requestedTime')->nullable();

            $table->index('medical_staff_id');
            $table->index('appointment_id');
            $table->index('location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referrals');
    }
}
