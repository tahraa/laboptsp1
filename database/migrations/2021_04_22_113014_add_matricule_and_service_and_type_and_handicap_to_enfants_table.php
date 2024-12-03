<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatriculeAndServiceAndTypeAndHandicapToEnfantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enfants', function (Blueprint $table) {
            $table->string('matricule');
            $table->string('service')->nullable(true);
            $table->string('type')->nullable(true);
            $table->boolean('handicap')->nullable(true);
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
            $table->dropColumn(['matricule', 'service', 'type', 'handicap']);
        });
    }
}
