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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('age_id')->nullable();
            $table->foreignId('sexe_id')->nullable()->constrained();
            $table->string('animal_name')->nullable();
            $table->text('personnality')->nullable();
            $table->unsignedBigInteger('espece_id')->nullable();
            $table->unsignedBigInteger('race_id')->nullable();
            $table->boolean('male_dogs')->nullable();
            $table->boolean('female_dogs')->nullable();
            $table->boolean('male_cats')->nullable();
            $table->boolean('female_cats')->nullable();
            $table->boolean('male_rongeurs')->nullable();
            $table->boolean('female_rongeurs')->nullable();
            $table->boolean('birds')->nullable();
            $table->boolean('reptiles')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
};
