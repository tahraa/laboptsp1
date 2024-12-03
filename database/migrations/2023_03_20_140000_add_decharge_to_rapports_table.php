<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDechargeToRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->string('decharge')->nullable(true);
        });
    }


    public function down()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropColumn(['decharge']);
        });
    }
}
