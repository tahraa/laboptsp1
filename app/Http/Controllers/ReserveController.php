<?php

namespace App\Http\Controllers;

use App\Reserve;


use App\Affaire;
use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReserveController extends Controller
{


   public function create()
    {
        $affaires = Affaire::all();
        return view('reste_scelle.create', [
            'affaires' => $affaires,
        ]);
    }




public function store(Request $request)
    {
        $validation = [
            'caracteristiques' => 'required',
            'employe' => 'required|not_in:vide',
			 'etat' => 'required',
			 
        ];
        $request->validate($validation);

        $Intervenant = new Reserve();
    

        $emp = Affaire::withCount(['reserves', 'intervenants','rapports','echantillons'])->findOrFail($request->input('employe'));
     
        $Intervenant->caracteristiques = $request->input('caracteristiques');
        $Intervenant->etat = $request->input('etat');
        $Intervenant->Affaire_id = $request->input('employe');
        $Intervenant->num_affaire = $emp->num_affaire;
        $Intervenant->periode_conservation = $request->input('periode_conservation');
        $Intervenant->save();

        $action = 'Ajout: Reste du Scellé(Déscription:'.$request->input('caracteristiques').' :'. $request->input('num_affaire') .' '.$request->input('etat') .')';
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
                'entite' => $Intervenant->num_affaire = $emp->num_affaire,
            ]);
        }

        return  back()->with('success', 'Reste du Scellé a été ajouté avec succès.');
    }









    public function index()
    {
        $user_id = auth()->user()->id;
       // $user_logged_in = \App\User::where(['id' => $user_id])->first();

            $commissariats = DB::table('reserves')->orderBy('num_affaire','desc')->paginate(500);

        $count_commissariats= DB::table('reserves')->count();


        return view(
            'reste_scelle.index',
            [
                'commissariats' => $commissariats,
                'count_commissariats' => $count_commissariats,
            ]
        );
    }

}