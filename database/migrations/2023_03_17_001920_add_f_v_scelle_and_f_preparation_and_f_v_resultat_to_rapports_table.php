<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFVScelleAndFPreparationAndFVResultatToRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->string('f_v_scelle')->nullable(true);
            $table->string('f_p')->nullable(true);
            $table->string('f_v_a_resultat')->nullable(true);
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
            $table->dropColumn(['f_v_scelle']);
            $table->dropColumn(['f_p']);
            $table->dropColumn(['f_v_a_resultat']);
        });
    }
}
