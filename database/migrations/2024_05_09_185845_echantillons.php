<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Echantillons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       Schema::create('echantillons', function (Blueprint $table) {
                 $table->bigIncrements('id');
			$table->string('num_echantillon');
              $table->string('periode_conservation');
              $table->string('etat');
            $table->string('num_affaire');
			    $table->string('description');
				   $table->string('traite');
            $table->unsignedBigInteger('affaire_id');
            $table->foreign('affaire_id')
                ->references('id')
                ->on('affaires');
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
          Schema::dropIfExists('echantillons');
    }
}
