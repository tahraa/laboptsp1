<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateNaissanceToEmployesTable extends Migration
{
    public function up()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->date('date_naissance')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->dropColumn('date_naissance');
        });
    }
}
