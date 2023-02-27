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
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('residenceStatus');
            $table->string('university');
            $table->string('city');
            $table->string('address');
            $table->string('profession');
            $table->string('job');
            $table->string('company');

            $table->string('civilStatus');
            $table->string('nbChildren');

            $table->string('firstNameReferent');
            $table->string('lastNameReferent');
            $table->string('emailReferent');
            $table->string('phoneReferent');
            $table->string('familyConnection');
            $table->timestamps();

            $table->bigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
};
