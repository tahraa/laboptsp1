<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GradeToIntervenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intervenants', function (Blueprint $table) {
            $table->string('grade')->nullable(true);
        });
    }


    public function down()
    {
        Schema::table('intervenants', function (Blueprint $table) {
            $table->dropColumn(['grade']);
        });
    }
}
