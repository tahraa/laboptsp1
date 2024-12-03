<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneticProfilesTable extends Migration
{
     public function up()
    {
        Schema::create('genetic_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affaire_id');
            $table->string('code')->unique();
            $table->string('prenom')->nullable(); 
            $table->string('nom')->nullable(); 
            $table->string('nni', 10)->unique()->nullable(); 
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('motif_nom')->nullable();
            $table->boolean('is_known')->default(false); 
            $table->string('nomcriminel')->nullable();
            $table->timestamps();

 
            $table->foreign('affaire_id')->references('id')->on('affaires');
        });
    }

    public function down()
    {
        Schema::dropIfExists('genetic_profiles');
    }
}
