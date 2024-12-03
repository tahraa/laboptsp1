<?php

namespace App\Console\Commands;

use App\Beneficier;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class everyday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:contractuel_rule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
      //Enfant's beneficier age handling
      $beneficiers = DB::table('beneficiers')->orderBy('id','desc')->get();
      foreach ($beneficiers as $ben) {
          $b = Beneficier::findOrFail($ben->id);
           $timeof = Carbon::parse($b->date_recrutement)->age;
           $delai=$b->delai;
           if ($timeof<$delai)  {
               $b->statut = true;
               $b->save();
               echo 'Succefull beneficier';

              }else{
                  $b->statut = false;
                  $b->save();
                  echo 'Succefull beneficier';}
           }
    }
}
