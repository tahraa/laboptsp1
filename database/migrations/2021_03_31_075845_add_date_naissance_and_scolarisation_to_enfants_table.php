<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateNaissanceAndScolarisationToEnfantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enfants', function (Blueprint $table) {
            $table->boolean('scolarite');
            $table->date('date_naissance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enfants', function (Blueprint $table) {
            $table->dropColumn(['scolarite', 'date_naissance']);
        });
    }
}
