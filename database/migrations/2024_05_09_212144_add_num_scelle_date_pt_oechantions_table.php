<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumScelleDatePtOechantionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   Schema::table('echantillons', function (Blueprint $table) {
            $table->string('num_scelle')->nullable(true);
			        $table->date('datep')->nullable(true);
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
            $table->dropColumn(['datep']);
			$table->dropColumn(['num_scelle']);
        });
    }
}
