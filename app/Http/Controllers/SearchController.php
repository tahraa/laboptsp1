<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
class SearchController extends Controller
{
    public function getSearch(Request $request)
    {
        //get keywords input for search
        $keyword=  $request->input('q');
        $field=  $request->input('field');

        //search that student in Database
        if ($field == 'matricule') {
            $employe= Employe::where('matricule',$keyword)->firstOrFail();
        }
        if ($field == 'nni') {
            $employe= Employe::where('nni',$keyword)->firstOrFail();
        }
        if ($field == 'nom') {
            $employe= Employe::where('nom','like','%'.$keyword.'%')->firstOrFail();
        }

        //return display search result to user by using a view
        return //View::make('selfservice')->with('student', $students);
            view('employes.show',[
                'employe' => $employe]);
    }

    public function search(){
        $employes = Employe::all();
        return view('employes.search',[
            'employes' => $employes,
        ]);
    }
    

}
