<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferencesToAffairesTable extends Migration
{

    public function up()
    {
        Schema::table('affaires', function (Blueprint $table) {
            $table->string('reference')->nullable(true);
        });
    }

    public function down()
    {
        Schema::table('affaires', function (Blueprint $table) {
            $table->dropColumn('reference');
        });
    }
}
