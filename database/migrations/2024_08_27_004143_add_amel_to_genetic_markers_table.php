<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmelToGeneticMarkersTable extends Migration
{
   
    public function up()
    {
        Schema::table('genetic_markers', function (Blueprint $table) {
            $table->enum('Amel', ['XX', 'XY'])->nullable()->after('FGA_c');
        });
    }

  
    public function down()
    {
        Schema::table('genetic_markers', function (Blueprint $table) {
            $table->dropColumn('Amel');
        });
    }
}
