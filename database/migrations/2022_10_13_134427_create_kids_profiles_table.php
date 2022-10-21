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
        Schema::create('kids_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_profile_id');
            $table->string('kid_name');
            $table->string('kid_surname');
            $table->date('date_of_birth');
            $table->longText('additional_information');
            $table->timestamps();

            $table->foreign('user_profile_id')->references('id')->on('users_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kids_profiles');
    }
};
