<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPAndCAndDToRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->string('p')->nullable(true);
            $table->string('c')->nullable(true);
            $table->string('d')->nullable(true);
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
            $table->dropColumn(['p']);
            $table->dropColumn(['c']);
            $table->dropColumn(['d']);

        });
    }
}
