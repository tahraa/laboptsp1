<?php

namespace App\Http\Controllers;

use App\Beneficier;
use App\EnfantB;
use App\Logs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnfantbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if($user_logged_in['profile'] == 'profil2'){
            $enfants = DB::table('enfant_b_s')->where('etablissement', $user_logged_in['etablissement'])->orderBy('matricule','desc')->paginate(500);
        }else{
            $enfants = DB::table('enfant_b_s')->orderBy('matricule','desc')->paginate(500);
        }

        $count_enfants = DB::table('enfant_b_s')->count();


        return view(
            'enfantsB.index',
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
        $beneficiers = Beneficier::all();
        return view('enfantsB.create', [
            'beneficiers' => $beneficiers,
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
            'nni' => 'required|digits:10|unique:enfant_b_s|numeric' ,
            'num_cnam' => 'required|digits:8|unique:enfant_b_s|numeric' ,
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'statut' => 'required',
            'e_image' => 'required',
            'beneficier' => 'required|not_in:vide',
            'date_naissance' => 'required',
            'scolarite' => 'required',
        ];
        $request->validate($validation);
        $enfant = new EnfantB();
        $image = '';
        if ($request->hasFile('e_image')) {

            $request->file('e_image')->storePubliclyAs(
                'enfant_images',
                $request->input('nni').'.jpg'
            );
            $image = $request->input('nni').'.jpg';
            $enfant->image = $image;
        }
        $beneficier = Beneficier::withCount(['couples', 'enfants'])->findOrFail($request->input('beneficier'));
        $enfant->nni = $request->input('nni');
        $enfant->nom = $request->input('nom');
        $enfant->prenom = $request->input('prenom');
        $enfant->sexe = $request->input('sexe');
        $enfant->statut = $request->input('statut');
        $enfant->beneficier_id = $request->input('beneficier');
        $enfant->num_cnam = $request->input('num_cnam');
        $enfant->date_naissance = $request->input('date_naissance');
        $enfant->scolarite = $request->input('scolarite');
        $enfant->handicap = false;
        $enfant->type = 'Enfant';
        $enfant->service = $beneficier->service;
        $enfant->etablissement = $beneficier->etablissement;
        $enfant->matricule = $beneficier->matricule;

        $enfant->save();


        $action = 'Création : EnfantB(nom:'.$request->input('nom'). ' nni:'.$request->input('nni') .' emp_id:'. $request->input('beneficier') .')';
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action ,
                'entite' => $enfant->matricule,

            ]);
        }

        return back()->with('success', 'l’enfant a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('enfantsB.show', [
            'enfant' => EnfantB::findOrFail($id),
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
        $enfant = EnfantB::findOrFail($id);
        return view('enfantsB.edit', [
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
        $enfant = EnfantB::findOrFail($id);
        if ($enfant->nni != $request->input('nni')) {
            $changement .= 'nni('.$enfant->nni.'=>'.$request->input('nni').')';
        }
        /* if ($enfant->nni != $request->input('num_cnam')) {
            $changement .= 'num_cnam('.$enfant->nni.'=>'.$request->input('num_cnam').')';
        } */
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
        // $enfant->num_cnam = $request->input('num_cnam');
        // $image ='';
        if ($request->hasFile('e_image')){
            $request->file('e_image')->storePubliclyAs(
                'enfant_images',
                $request->input('nni').'.jpg'
            );
            $image = $request->input('nni').'.jpg';
            $enfant->image = $image;
        }
        $enfant->save();

        $action = 'Modification : EnfantB(nom:'.$request->input('nom').' nni:'.$request->input('nni').') changement :'.$changement ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action
            ]);
        }
        $request->session()->flash('success', 'L\' enfant a été modifier avec succès :)');
        return back()->with('success', 'L\' enfant a été modifier avec succès :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $enfant = EnfantB::find($id);
        $enfant->delete(); // OU Post::destroy($id);
        $action = 'Suppression : EnfantB(nni:'.$enfant->nni.' nom:'.$enfant->nom.')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first();
            if (!($user_logged_in->name == 'dev')) {
                # code...
                $log = Logs::create([
                    'userid' => $user_logged_in->id,
                    'user' => $user_logged_in->name,
                    'email' => $user_logged_in->email,
                    'action' => $action,
                    'entite' => $enfant->matricule,
                ]);
            }
        $request->session()->flash('success', 'L\'enfant est supprimé avec succès');
        return redirect()->route('enfantsB.index');
    }
}
