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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('photo')->nullable();

            $table->unsignedBigInteger('ville_id')->onDelete('cascade')->nullable();
            
            /* CODE API COMMUNE */
            $table->string('ville_code')->nullable();
            $table->string('ville_name')->nullable();
            $table->string('region_code')->nullable();

            $table->unsignedBigInteger('habitation_id')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('exterieur_id')->onDelete('cascade')->nullable(); 

            $table->boolean('status')->default(1);
            
            $table->date('start_watch')->nullable();
            $table->date('end_watch')->nullable();
            
            $table->unsignedBigInteger('garde_id')->nullable();

            $table->unsignedBigInteger('chats')->nullable();  
            $table->unsignedBigInteger('chiens')->nullable();
            $table->unsignedBigInteger('poissons')->nullable();
            $table->unsignedBigInteger('rongeurs')->nullable();
            $table->unsignedBigInteger('oiseaux')->nullable();
            $table->unsignedBigInteger('reptiles')->nullable();
            $table->unsignedBigInteger('ferme')->nullable();
            $table->unsignedBigInteger('autre')->nullable();
            $table->text('description')->nullable();  
            $table->integer('price')->nullable();
            $table->unsignedBigInteger('user_id')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('annonces');
    }
};
