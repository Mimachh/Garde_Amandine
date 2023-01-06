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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->nullableTimestamps();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('first_animal_id')->nullable()->constrained('animals')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('second_animal_id')->nullable()->constrained('animals')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('third_animal_id')->nullable()->constrained('animals')->onDelete('set null')->onUpdate('cascade');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('garde_id')->nullable();
            $table->integer('number_visit')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->integer('prix_final')->nullable();
            $table->unsignedBigInteger('proposal_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
};
