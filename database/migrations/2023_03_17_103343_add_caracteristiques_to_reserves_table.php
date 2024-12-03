<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCaracteristiquesToReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reserves', function (Blueprint $table) {
            $table->string('caracteristiques')->nullable(true);
        });
    }

    public function down()
    {
        Schema::table('reserves', function (Blueprint $table) {
            $table->dropColumn(['caracteristiques']);

        });
    }
}
