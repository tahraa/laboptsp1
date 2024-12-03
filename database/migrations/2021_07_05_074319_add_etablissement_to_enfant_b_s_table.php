<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtablissementToEnfantBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enfant_b_s', function (Blueprint $table) {
            $table->string('etablissement')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enfant_b_s', function (Blueprint $table) {
            $table->dropColumn('etablissement');
        });
    }
}
