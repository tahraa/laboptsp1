<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumCnamToEnfantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enfants', function (Blueprint $table) {
            $table->integer('num_cnam')->nullable(true);
        });
    }


    public function down()
    {
        Schema::table('enfants', function (Blueprint $table) {
            $table->dropColumn('num_cnam');
        });
    }
}
