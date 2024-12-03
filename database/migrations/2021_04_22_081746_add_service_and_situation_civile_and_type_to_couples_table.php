<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceAndSituationCivileAndTypeToCouplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('couples', function (Blueprint $table) {
            $table->string('situation_civile');
            $table->string('type');
            $table->string('matricule');
            $table->string('service')->nullable(true);
            $table->string('situation_de_famille')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('couples', function (Blueprint $table) {
            $table->dropColumn(['situation_civile', 'type', 'matricule', 'service', 'situation_de_famille']);
        });
    }
}
