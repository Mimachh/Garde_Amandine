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
        Schema::table('users', function ($table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::table('animals', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreign('espece_id')->references('id')->on('especes');
            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('age_id')->references('id')->on('ages');

        });

        Schema::table('annonces', function(Blueprint $table) {
       
            $table->foreign('ville_id')->references('id')->on('villes')->onDelete('set null');
            $table->foreign('habitation_id')->references('id')->on('habitations')->onDelete('set null');
            $table->foreign('exterieur_id')->references('id')->on('exterieurs')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           
            $table->foreign('chats')->references('id')->on('especes')
            ->onDelete('set null')
            ->onUpdate('cascade'); 
            $table->foreign('chiens')->references('id')->on('especes')
            ->onDelete('set null')
            ->onUpdate('cascade'); 
            $table->foreign('poissons')->references('id')->on('especes')
            ->onDelete('set null')
            ->onUpdate('cascade'); 
            $table->foreign('rongeurs')->references('id')->on('especes')
            ->onDelete('set null')
            ->onUpdate('cascade'); 
            $table->foreign('reptiles')->references('id')->on('especes')
            ->onDelete('set null')
            ->onUpdate('cascade'); 
            $table->foreign('ferme')->references('id')->on('especes')
            ->onDelete('set null')
            ->onUpdate('cascade'); 
            $table->foreign('autre')->references('id')->on('especes')
            ->onDelete('set null')
            ->onUpdate('cascade'); 
            $table->foreign('oiseaux')->references('id')->on('especes')
            ->onDelete('set null')
            ->onUpdate('cascade');
            $table->foreign('garde_id')->references('id')->on('gardes')
            ->onDelete('set null')
            ->onUpdate('cascade'); 
        });

        Schema::table('races', function(Blueprint $table) {
            $table->foreign('espece_id')->references('id')->on('especes'); 
        
        });

        Schema::table('demandes', function(Blueprint $table) {
            $table->foreign('garde_id')->references('id')->on('gardes')->onDelete('set null')->onUpdate('cascade');  
            $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade')->onUpdate('cascade');
            /* $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade'); pas besoin je crois */  
        
        });

        Schema::table('proposals', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');; 
            $table->foreign('annonce_id')->references('id')->on('annonces')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad__foreign__key__controllers');
    }
};
