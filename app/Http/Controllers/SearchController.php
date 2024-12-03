<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Affaire;
use App\Rapport;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
  

    public function search()    {
		
	   $emps = DB::table('affaires')->where('resultat', '=', 1)->orderBy('date','desc')->paginate(500);
    $count_emps = DB::table('affaires')->where('resultat', '=', 1)->count();
    return view(
        'employes.search',
        [
            'emps' => $emps,
            'count_emps' => $count_emps,
        ]

    );}

}
