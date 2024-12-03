<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateCoupleBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couple_b_s', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nni', 120);
            $table->string('nom', 120);
            $table->string('prenom', 120);
            $table->date('date_naissance')->nullable(true);
            $table->date('date_mariage')->nullable(true);
            $table->string('sexe', 100);
            $table->string('matricule', 120);
            $table->integer('num_cnam')->nullable(true);
            $table->string('image')->nullable(true);
            $table->string('type')->nullable(true);
            $table->string('service')->nullable(true);
            $table->string('situation_civile')->nullable(true);
            // $table->increments('mat')->start_from(100000);
            $table->boolean('statut');

            $table->unsignedBigInteger('beneficier_id');
            $table->foreign('beneficier_id')
                ->references('id')
                ->on('beneficiers');
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
        Schema::dropIfExists('couple_b_s');
    }
}
