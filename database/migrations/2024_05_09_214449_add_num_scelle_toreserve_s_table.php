<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumScelleToreserveSTable extends Migration
{
  
    public function up()
    {
        Schema::table('reserves', function (Blueprint $table) {
            $table->string('num_scelle')->nullable(true);
			      
        });
    }

   
    public function down()
    {
           Schema::table('reserves', function (Blueprint $table) {
     	$table->dropColumn(['num_scelle']);
        });
    }
}
