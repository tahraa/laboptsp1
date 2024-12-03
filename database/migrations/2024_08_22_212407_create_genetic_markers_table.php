<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneticMarkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genetic_markers', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('genetic_profile_id')->unique();

            // Colonnes pour les marqueurs avec deux chiffres avant la virgule et un chiffre après la virgule
            $table->decimal('D3S1358_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D3S1358_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D3S1358_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D1S1656_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D1S1656_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D1S1656_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D6S1043_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D6S1043_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D6S1043_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D13S317_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D13S317_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D13S317_c', 3, 1)->unsigned()->nullable();

            $table->decimal('Penta_E_a', 3, 1)->unsigned()->nullable();
            $table->decimal('Penta_E_b', 3, 1)->unsigned()->nullable();
            $table->decimal('Penta_E_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D16S539_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D16S539_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D16S539_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D18S51_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D18S51_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D18S51_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D2S1338_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D2S1338_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D2S1338_c', 3, 1)->unsigned()->nullable();

            $table->decimal('DSF1PO_a', 3, 1)->unsigned()->nullable();
            $table->decimal('DSF1PO_b', 3, 1)->unsigned()->nullable();
            $table->decimal('DSF1PO_c', 3, 1)->unsigned()->nullable();

            $table->decimal('Penta_D_a', 3, 1)->unsigned()->nullable();
            $table->decimal('Penta_D_b', 3, 1)->unsigned()->nullable();
            $table->decimal('Penta_D_c', 3, 1)->unsigned()->nullable();

            $table->decimal('THO1_a', 3, 1)->unsigned()->nullable();
            $table->decimal('THO1_b', 3, 1)->unsigned()->nullable();
            $table->decimal('THO1_c', 3, 1)->unsigned()->nullable();

            $table->decimal('VWA_a', 3, 1)->unsigned()->nullable();
            $table->decimal('VWA_b', 3, 1)->unsigned()->nullable();
            $table->decimal('VWA_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D21S11_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D21S11_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D21S11_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D7S820_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D7S820_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D7S820_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D55818_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D55818_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D55818_c', 3, 1)->unsigned()->nullable();

            $table->decimal('TPOX_a', 3, 1)->unsigned()->nullable();
            $table->decimal('TPOX_b', 3, 1)->unsigned()->nullable();
            $table->decimal('TPOX_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D8S1179_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D8S1179_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D8S1179_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D12S391_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D12S391_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D12S391_c', 3, 1)->unsigned()->nullable();

            $table->decimal('D19S433_a', 3, 1)->unsigned()->nullable();
            $table->decimal('D19S433_b', 3, 1)->unsigned()->nullable();
            $table->decimal('D19S433_c', 3, 1)->unsigned()->nullable();

            $table->decimal('FGA_a', 3, 1)->unsigned()->nullable();
            $table->decimal('FGA_b', 3, 1)->unsigned()->nullable();
            $table->decimal('FGA_c', 3, 1)->unsigned()->nullable();

            $table->timestamps();

                 // Clé étrangère avec une contrainte d'intégrité référentielle forte
            $table->foreign('genetic_profile_id')
                  ->references('id')
                  ->on('genetic_profiles')
                  ->onDelete('cascade') // Assurer que le profil génétique ne peut pas être supprimé s'il est lié à un marqueur
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('genetic_markers');
    }
}


