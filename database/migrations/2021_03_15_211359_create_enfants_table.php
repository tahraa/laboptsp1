<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nni', 120);
            $table->string('nom', 120);
            $table->string('prenom', 120);
            $table->string('sexe', 100);
            $table->boolean('statut');
            $table->unsignedBigInteger('employe_id');
            $table->foreign('employe_id')
                ->references('id')
                ->on('employes');
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
        Schema::dropIfExists('enfants');
    }
}
