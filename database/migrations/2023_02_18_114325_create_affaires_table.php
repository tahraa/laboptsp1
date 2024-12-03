<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 120);
            $table->date('date');
            $table->string('num_affaire');


            $table->unsignedBigInteger('commiseriat_id');
            $table->foreign('commiseriat_id')
                ->references('id')
                ->on('commiseriats');
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
        Schema::dropIfExists('affaires');
    }
}
