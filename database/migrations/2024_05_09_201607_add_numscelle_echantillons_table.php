<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumscelleEchantillonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('echantillons', function (Blueprint $table) {
					$table->string('num_scelle');
        });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('echantillons', function (Blueprint $table) {
             $table->dropColumn(['num_scelle']);
        });
    }
}
