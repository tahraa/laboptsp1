<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFGenotypageAndFQToRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->string('f_genotypage')->nullable(true);
            $table->string('f_Q')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropColumn(['f_genotypage']);
            $table->dropColumn(['f_Q']);
        });
    }
}
