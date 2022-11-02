<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('time');
            $table->integer('user_profile');
            $table->integer('kid_profile');

            $table->foreign('user_profile')->references('id')->on('users_profiles');
            $table->foreign('kid_profile')->references('id')->on('kids_profiles');

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
        Schema::dropIfExists('reservations');
    }
};
