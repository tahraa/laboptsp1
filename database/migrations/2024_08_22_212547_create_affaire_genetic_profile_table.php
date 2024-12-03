<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffaireGeneticProfileTable extends Migration
{
 public function up()
    {
        Schema::create('affaire_genetic_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affaire_id');
            $table->unsignedBigInteger('genetic_profile_id');
            // Ajoutez des colonnes supplémentaires selon vos besoins
            $table->timestamps();

            // Clés étrangères
            $table->foreign('affaire_id')->references('id')->on('affaires')->onDelete('cascade');
            $table->foreign('genetic_profile_id')->references('id')->on('genetic_profiles')->onDelete('cascade');

            // Assurez-vous que la combinaison de affaire_id et genetic_profile_id est unique
            $table->unique(['affaire_id', 'genetic_profile_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('affaire_genetic_profile');
    }
}
