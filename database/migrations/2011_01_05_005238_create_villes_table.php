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
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('ville_departement')->nullable();
            $table->string('ville_slug')->nullable();
            $table->string('ville_nom')->nullable();
            $table->string('ville_nom_simple')->nullable();
            $table->string('ville_nom_reel')->nullable();
            $table->string('ville_code_postal')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villes');
    }
};
