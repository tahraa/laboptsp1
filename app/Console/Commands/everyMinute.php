<?php

namespace App\Console\Commands;

use App\Beneficier;
use App\Enfant;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:enf_rule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'enfants status rules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            //Enfant's employe age handling
            $enfants = DB::table('enfants')->orderBy('id','desc')->get();
            foreach ($enfants as $enfant) {
                $en = Enfant::findOrFail($enfant->id);
                $age = Carbon::parse($en->date_naissance)->age;
                if (($age >= 18 && $age <= 21) && $en->scolarite == true) {
                    $en->statut = true;
                    $en->save();
                    echo 'Succefull enfant\'s employe';
                }elseif($age <= 18){
                    $en->statut = true;
                    $en->save();
                    echo 'Succefull enfant\'s employe';
                }else{
                    $en->statut = false;
                    $en->save();
                    echo 'Succefull enfant\'s employe';
                }
            }

            //Enfant's beneficier age handling
            $enfant_b_s = DB::table('enfant_b_s')->orderBy('id','desc')->get();
            foreach ($enfant_b_s as $enfant) {
                $en = Beneficier::findOrFail($enfant->id);
                 $age = Carbon::parse($en->date_naissance)->age;
                 if (($age >= 18 && $age <= 21) && $en->scolarite == true) {
                     $en->statut = true;
                     $en->save();
                     echo 'Succefull enfant\'s beneficier';
                    }elseif($age <= 18){
                        $en->statut = true;
                        $en->save();
                        echo 'Succefull enfant\'s beneficier';
                    }else{
                        $en->statut = false;
                        $en->save();
                        echo 'Succefull enfant\'s beneficier';
                 }
            }
    }
}
