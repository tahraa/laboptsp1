<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMethodeAnalyseToRapportsTable extends Migration
{

    public function up()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->string('methode_analyse')->nullable(true);
        });
    }

    public function down()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropColumn('methode_analyse');

        });
    }
}
