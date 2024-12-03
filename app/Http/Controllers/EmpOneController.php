<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commiseriat;
use App\Affaire;
use App\Logs;


class EmpOneController extends Controller
{




    public function create()
    {    $c = Commiseriat::all();
        return view('empone.create'     , ['c' =>  $c,]);

    }


    public function store(Request $request)
    {
        $validation = [
            'num_affaire' => 'required|unique:affaires',
            'type' => 'required',
            'date' => 'required',
            'num_soit => numeric',
        ];
        $request->validate($validation);
        $affaire = new Affaire();
        $emp = Commiseriat::withCount(['affaires'])->findOrFail($request->input('employe'));
        $affaire->num_affaire=$request->input('num_affaire');
        $affaire->type=$request->input('type');
        $affaire->commiseriat_id = $request->input('employe');
        $affaire->num_affaire_c=$request->input('num_affaire_c');
        $affaire->lieu_crime=$request->input('lieu_crime');
		    $affaire->lieu_prelevement=$request->input('lieu_prelevement');
				        $affaire->date_prelevement=$request->input('date_prelevement');
        $affaire->reference=$request->input('reference');
        $affaire->num_soit=$request->input('num_soit');
        $affaire->partie_declarent = $emp->nom." DRS ".$emp->region;
        $affaire->date=$request->input('date');
        $affaire->save();

        $action = 'Création : Affaire(N°affaire:'.$request->input('num_affaire').' ,'.'type: '.$request->input('type').')';
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
                'entite' => $affaire->num_affaire,
            ]);
        }
        return back()->with('success', 'Affaire a été ajouter avec succès :).');
    }



}
