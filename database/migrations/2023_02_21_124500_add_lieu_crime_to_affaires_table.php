<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLieuCrimeToAffairesTable extends Migration
{

    public function up()
    {
        Schema::table('affaires', function (Blueprint $table) {
            $table->string('lieu_crime')->nullable(true);
        });
    }


    public function down()
    {
        Schema::table('affaires', function (Blueprint $table) {
            $table->dropColumn('lieu_crime');
        });
    }
}
