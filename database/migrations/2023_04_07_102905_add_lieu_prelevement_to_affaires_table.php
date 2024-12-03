<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLieuPrelevementToAffairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affaires', function (Blueprint $table) {
               $table->string('lieu_prelevement')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affaires', function (Blueprint $table) {
                $table->dropColumn(['lieu_prelevement']);
        });
    }
}
