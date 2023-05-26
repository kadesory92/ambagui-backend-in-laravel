<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->string('photo');
            $table->string('filePassport');
            $table->string('gender')->default('M')->comment('M for Male, F Female');
            $table->string('residenceStatus')->default('STD')->comment('STD for Student, 
                DPT for Diplomat, MLR for Military,TRT for Tourist, WRK for Worker');
            $table->string('university')->nullable();
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('profession')->nullable();
            $table->string('job')->nullable();
            $table->string('company')->nullable();

            $table->string('civilStatus')->nullable();
            $table->string('nbChildren')->nullable();

            $table->string('firstNameReferent')->nullable();
            $table->string('lastNameReferent')->nullable();
            $table->string('emailReferent')->nullable();
            $table->string('phoneReferent')->nullable();
            $table->string('familyConnection')->nullable();
            $table->timestamps();

            $table->foreignIdFor(User::class);
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
