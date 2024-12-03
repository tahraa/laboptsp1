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

            // Ajout des colonnes pour chaque marqueur Y avec suffixes _a et _b
            $table->decimal('DYS576_a', 3, 1)->nullable();
            $table->decimal('DYS576_b', 3, 1)->nullable();

            $table->decimal('DYS389I_a', 3, 1)->nullable();
            $table->decimal('DYS389I_b', 3, 1)->nullable();

            $table->decimal('DYS448_a', 3, 1)->nullable();
            $table->decimal('DYS448_b', 3, 1)->nullable();

            $table->decimal('DYS389II_a', 3, 1)->nullable();
            $table->decimal('DYS389II_b', 3, 1)->nullable();

            $table->decimal('DYS19_a', 3, 1)->nullable();
            $table->decimal('DYS19_b', 3, 1)->nullable();

            $table->decimal('DYS391_a', 3, 1)->nullable();
            $table->decimal('DYS391_b', 3, 1)->nullable();

            $table->decimal('DYS481_a', 3, 1)->nullable();
            $table->decimal('DYS481_b', 3, 1)->nullable();

            $table->decimal('DYS549_a', 3, 1)->nullable();
            $table->decimal('DYS549_b', 3, 1)->nullable();

            $table->decimal('DY533_a', 3, 1)->nullable();
            $table->decimal('DY533_b', 3, 1)->nullable();

            $table->decimal('DY438_a', 3, 1)->nullable();
            $table->decimal('DY438_b', 3, 1)->nullable();

            $table->decimal('DY437_a', 3, 1)->nullable();
            $table->decimal('DY437_b', 3, 1)->nullable();

            $table->decimal('DYS570_a', 3, 1)->nullable();
            $table->decimal('DYS570_b', 3, 1)->nullable();

            $table->decimal('DYS635_a', 3, 1)->nullable();
            $table->decimal('DYS635_b', 3, 1)->nullable();

            $table->decimal('DYS390_a', 3, 1)->nullable();
            $table->decimal('DYS390_b', 3, 1)->nullable();

            $table->decimal('DYS439_a', 3, 1)->nullable();
            $table->decimal('DYS439_b', 3, 1)->nullable();

            $table->decimal('DYS392_a', 3, 1)->nullable();
            $table->decimal('DYS392_b', 3, 1)->nullable();

            $table->decimal('DYS643_a', 3, 1)->nullable();
            $table->decimal('DYS643_b', 3, 1)->nullable();

            $table->decimal('DYS393_a', 3, 1)->nullable();
            $table->decimal('DYS393_b', 3, 1)->nullable();

            $table->decimal('DYS458_a', 3, 1)->nullable();
            $table->decimal('DYS458_b', 3, 1)->nullable();

            $table->decimal('DYS385_a', 3, 1)->nullable();
            $table->decimal('DYS385_b', 3, 1)->nullable();

            $table->decimal('DYS456_a', 3, 1)->nullable();
            $table->decimal('DYS456_b', 3, 1)->nullable();

            $table->decimal('YGATAH4_a', 3, 1)->nullable();
            $table->decimal('YGATAH4_b', 3, 1)->nullable();

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
