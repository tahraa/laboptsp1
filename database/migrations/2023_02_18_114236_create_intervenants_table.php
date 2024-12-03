<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom', 120);
            $table->string('prenom', 120);
            $table->string('matricule', 120);
            $table->date('date_intervention');
            $table->string('image');
            $table->unsignedBigInteger('affaire_id');
            $table->foreign('affaire_id')
                ->references('id')
                ->on('affaires');
            $table->timestamps();
        });
    }













    public function down()
    {
        Schema::dropIfExists('intervenants');
    }
}
