<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Enfant;
use App\Logs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnfantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enfants = DB::table('enfants')->orderBy('id','desc')->get();
        $count_enfants = DB::table('enfants')->count();
        
       
        return view(
            'enfants.index',
            [
                'enfants' => $enfants,
                'count_enfants' => $count_enfants,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employe::all();
        return view('enfants.create', [
            'employes' => $employes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = [
            'nni' => 'required|digits:10|unique:couples|numeric' ,
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'statut' => 'required',
            'e_image' => 'required',
            'employe' => 'required',
            'date_naissance' => 'required',
            'scolarite' => 'required',
        ];
        $request->validate($validation);
        if ($request->hasFile('e_image')) {

            $request->file('e_image')->storePubliclyAs(
                'enfant_images',
                $request->input('nni').'.jpg'
            );
        }
        $couple = Enfant::create([
            'nni' => $request->input('nni'),
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'sexe' => $request->input('sexe'),
            'statut' => $request->input('statut'),
            'employe_id' => $request->input('employe'),
            'date_naissance' => $request->input('date_naissance'),
            'scolarite' => $request->input('scolarite'),
        ]);
        
        $action = 'Création : Enfant(nom:'.$request->input('nom'). ' nni:'.$request->input('nni') .' emp_id:'. $request->input('employe') .')';
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first(); 

        $log = Logs::create([
            'userid' => $user_logged_in->id,
            'user' => $user_logged_in->name,
            'email' => $user_logged_in->email,
            'action' => $action
        ]);
        
        return back()->with('success', 'l\'enfant déclarer avec succès :).');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('enfants.show', [
            'enfant' => Enfant::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enfant = Enfant::findOrFail($id);
        return view('enfants.edit', [
            'enfant' => $enfant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = [
            'nni' => 'required|digits:10|numeric',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'statut' => 'required',
            
        ];
        $request->validate($validation);
        $changement ='';
        $enfant = Enfant::findOrFail($id);
        if ($enfant->nni != $request->input('nni')) {
            $changement .= 'nni('.$enfant->nni.'=>'.$request->input('nni').')'; 
        }
        if ($enfant->nom != $request->input('nom')) {
            $changement .= 'nom('.$enfant->nom.'=>'.$request->input('nom').')'; 
        }
        if ($enfant->prenom != $request->input('prenom')) {
            $changement .= 'prenom('.$enfant->prenom.'=>'.$request->input('prenom').')'; 
        }
        if ($enfant->statut != $request->input('statut')) {
            $changement .= 'statut('.$enfant->statut.'=>'.$request->input('statut').')'; 
        }
        if ($enfant->sexe != $request->input('sexe')) {
            $changement .= 'sexe('.$enfant->sexe.'=>'.$request->input('sexe').')'; 
        }
        if ($enfant->date_naissance != $request->input('date_naissance')) {
            $changement .= 'date_naissance('.$enfant->date_naissance.'=>'.$request->input('date_naissance').')'; 
        }
        if ($enfant->scolarite != $request->input('scolarite')) {
            $changement .= 'scolarite('.$enfant->scolarite.'=>'.$request->input('scolarite').')'; 
        }
        $enfant->nni = $request->input('nni');
        $enfant->nom = $request->input('nom');
        $enfant->prenom = $request->input('prenom');
        $enfant->statut = $request->input('statut');
        $enfant->sexe = $request->input('sexe');
        $enfant->date_naissance = $request->input('date_naissance');
        $enfant->scolarite = $request->input('scolarite');
        if ($request->hasFile('e_image')){
            $request->file('e_image')->storePubliclyAs(
                'enfant_images',
                $request->input('nni').'.jpg'
            );
        }
        $enfant->save();

        $action = 'Modification : Enfant(nom:'.$request->input('nom').' nni:'.$request->input('nni').') changement :'.$changement ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first(); 

        $log = Logs::create([
            'userid' => $user_logged_in->id,
            'user' => $user_logged_in->name,
            'email' => $user_logged_in->email,
            'action' => $action
        ]);
        $request->session()->flash('success', 'L\' enfant a été modifier avec succès :)');
        return back()->with('success', 'Conjoint a été modifier avec succès :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $enfant = Enfant::find($id);
        $enfant->delete(); // OU Post::destroy($id);
        $action = 'Suppression : Enfant(nni:'.$enfant->nni.' nom:'.$enfant->nom.')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first(); 
    
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action
            ]);
        $request->session()->flash('success', 'L\'enfant est supprimés avec succès');
        return redirect()->route('enfants.index');
    }
}
