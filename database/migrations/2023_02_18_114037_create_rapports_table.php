<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapportsTable extends Migration
{

    public function up()
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->bigIncrements('id');
           // $table->string('nom', 120);
            $table->date('date');
            $table->string('num_affaire');
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
        Schema::dropIfExists('rapports');
    }
}
