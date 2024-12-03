<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NumAffaireToIntervenantsTable extends Migration
{
    public function up()
    {
        Schema::table('intervenants', function (Blueprint $table) {
            $table->string('num_affaire');
        });
    }

    public function down()
    {
        Schema::table('intervenants', function (Blueprint $table) {
            $table->dropColumn(['num_affaire']);
        });
    }
}
