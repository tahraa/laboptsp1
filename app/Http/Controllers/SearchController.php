<?php

namespace App\Http\Controllers;

use App\Beneficier;
use Illuminate\Http\Request;
use App\Employe;
class SearchController extends Controller
{
    public function getSearch(Request $request)
    {
        //get keywords input for search
        $keyword=  $request->input('q');
        $field=  $request->input('field');
        $entite = $request->input('entite');

        //search that student in Database
        if ($field == 'matricule') {
            if ($entite == 'emp') {
                $employe= Employe::where('matricule',$keyword)->firstOrFail();
            } elseif($entite == 'ben') {
                $beneficier= Beneficier::where('matricule',$keyword)->firstOrFail();
            }
        }
        if ($field == 'nni') {
            if ($entite == 'emp') {
                $employe= Employe::where('nni',$keyword)->firstOrFail();
            } elseif($entite == 'ben') {
                $beneficier= Beneficier::where('nni',$keyword)->firstOrFail();
            }
        }
        if ($field == 'prenom') {
            if ($entite == 'emp') {
                $employe= Employe::where('prenom','like','%'.$keyword.'%')->firstOrFail();
            } elseif($entite == 'ben') {
                $beneficier= Beneficier::where('prenom','like','%'.$keyword.'%')->firstOrFail();
            }
        }


        if ($entite == 'emp') {
            return 
            view('employes.show',[
                'employe' => $employe]);
        }else{
            return 
            view('beneficiers.show',[
                'beneficier' => $beneficier]);
        }
       
        
    }

    public function search(){
        $employes = Employe::all();
        $beneficiers = Beneficier::all();
        return view('employes.search',[
            'employes' => $employes,
            'beneficiers' => $beneficiers,
        ]);
    }


}
