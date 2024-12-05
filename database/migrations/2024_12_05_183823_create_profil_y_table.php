<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilYTable extends Migration
{
    public function up()
    {
        Schema::create('profil_y', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genetic_profile_id')->unique();

            // Ajout des colonnes pour chaque marqueur Y avec les valeurs a et b combinées dans une seule colonne
            $table->string('DYS576')->nullable();
            $table->string('DYS389I')->nullable();
            $table->string('DYS448')->nullable();
            $table->string('DYS389II')->nullable();
            $table->string('DYS19')->nullable();
            $table->string('DYS391')->nullable();
            $table->string('DYS481')->nullable();
            $table->string('DYS549')->nullable();
            $table->string('DY533')->nullable();
            $table->string('DY438')->nullable();
            $table->string('DY437')->nullable();
            $table->string('DYS570')->nullable();
            $table->string('DYS635')->nullable();
            $table->string('DYS390')->nullable();
            $table->string('DYS439')->nullable();
            $table->string('DYS392')->nullable();
            $table->string('DYS643')->nullable();
            $table->string('DYS393')->nullable();
            $table->string('DYS458')->nullable();
            $table->string('DYS385')->nullable();
            $table->string('DYS456')->nullable();
            $table->string('YGATAH4')->nullable();

            $table->timestamps();

            // Clé étrangère avec une contrainte d'intégrité référentielle forte
            $table->foreign('genetic_profile_id')
                  ->references('id')
                  ->on('genetic_profiles')
                  ->onDelete('cascade') // Assure que le profil génétique ne peut pas être supprimé s'il est lié à un marqueur
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profil_y');
    }
}
