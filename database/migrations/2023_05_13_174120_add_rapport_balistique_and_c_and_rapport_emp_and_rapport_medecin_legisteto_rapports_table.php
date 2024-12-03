<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRapportBalistiqueAndCAndRapportEmpAndRapportMedecinLegistetoRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->string('rapport_balistique')->nullable(true);
            $table->string('rapport_emp')->nullable(true);
            $table->string('rapport_medecin_legiste')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropColumn(['rapport_balistique']);
            $table->dropColumn(['rapport_emp']);
            $table->dropColumn(['rapport_medecin_legiste']);
        });
    }
}
