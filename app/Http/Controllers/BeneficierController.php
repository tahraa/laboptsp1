<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Beneficier;
use App\Couple;
use App\Enfant;
use App\Logs;


class BeneficierController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if($user_logged_in['profile'] == 'profil2'){
            $beneficiers = DB::table('beneficiers')->where('etablissement', $user_logged_in['etablissement'])->orderBy('matricule','desc')->paginate(500);
        }else{
            $beneficiers = DB::table('beneficiers')->orderBy('matricule','desc')->paginate(500);
        }
   // $beneficiers = DB::table('beneficiers')->orderBy('id','desc')->paginate(2);
   $count_beneficiers = DB::table('beneficiers')->count();
   return view(
       'beneficiers.index',
       [
           'beneficiers' => $beneficiers,
           'count_beneficiers' => $count_beneficiers,
       ]
   );
    }


    public function create()
    {
        $count_beneficiers = DB::table('beneficiers')->count();
        $max = 100000;
        if ($count_beneficiers > 0) {
            $max = (int)Beneficier::max('matricule') + 1;

        }
        return view('beneficiers.create', [
            'max' => $max
        ]);
    }


    public function store(Request $request)
    {
        $validation = [
            'nni' => 'required|digits:10|unique:employes|numeric' ,
            'num_cnam' => 'required|digits:8|unique:employes|numeric',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'matricule' => 'required|digits:6|unique:employes|numeric',
            'statut' => 'required',
            'emp_image' => 'required',
            'situation_civile' => 'required',
            'service' => 'required',
            'etablissement' => 'required',
        ];
        $request->validate($validation);
        $image='';
        if ($request->hasFile('emp_image')) {
            $request->file('emp_image')->storePubliclyAs(
                'avatars',
                $request->input('matricule').'.jpg'
            );
            $image = $request->input('matricule');
        }


        $emp = Beneficier::create([
            'nni' => $request->input('nni'),
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'sexe' => $request->input('sexe'),
            'matricule' => $request->input('matricule'),
            'statut' => $request->input('statut'),
            'num_cnam' => $request->input('num_cnam'),
            'situation_civile' => $request->input('situation_civile'),
            'service' => $request->input('service'),
            'etablissement' => $request->input('etablissement'),
            'date_naissance' => $request->input('date_naissance'),
            'image' => $image,

        ]);
/*
        $emp->type = 'emp'; */
        $action = 'Création : Tiers(mat:'.$request->input('matricule').' nom:'.$request->input('nom').')' ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'entite' => $emp->matricule,
                'action' => $action,
            ]);
        }

        return back()->with('success', 'le livret a été créé avec succès :).');
    }


    public function show($id)
    {
        return view('beneficiers.show', [
            'beneficier' => Beneficier::with(['couples', 'enfants'])->findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        $beneficier = Beneficier::withCount(['couples', 'enfants'])->findOrFail($id);
        $count_beneficiers = DB::table('beneficiers')->count();
        $max = 100000;
        if ($count_beneficiers > 0) {
            $max = (int)Beneficier::max('matricule') + 1;

        }
        return view('beneficiers.edit', [
            'beneficier' => $beneficier,'max' => $max
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
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'statut' => 'required',
            'date_naissance' => 'required'
        ];
        $request->validate($validation);
        $changement ='';
        $benef = Beneficier::findOrFail($id);
        if ($benef->nni != $request->input('nni')) {
            $changement .= 'nni('.$benef->nni.'=>'.$request->input('nni').')';
        }
        /* if ($benef->nni != $request->input('num_cnam')) {
            $changement .= 'num_cnam('.$benef->nni.'=>'.$request->input('num_cnam').')';
        } */
        /* if ($benef->matricule != $request->input('matricule')) {
            $changement .= 'matricule('.$benef->matricule.'=>'.$request->input('matricule').')';
        } */
        if ($benef->prenom != $request->input('prenom')) {
            $changement .= 'prenom('.$benef->prenom.'=>'.$request->input('prenom').')';
        }
        if ($benef->nom != $request->input('nom')) {
            $changement .= 'nom('.$benef->nom.'=>'.$request->input('nom').')';
        }
        if ($benef->statut != $request->input('statut')) {
            $changement .= 'statut('.$benef->statut.'=>'.$request->input('statut').')';
        }
        if ($benef->sexe != $request->input('sexe')) {
            $changement .= 'sexe('.$benef->sexe.'=>'.$request->input('sexe').')';
        }
        if ($benef->date_naissance != $request->input('date_naissance')) {
            $changement .= 'date_naissance('.$benef->date_naissance.'=>'.$request->input('date_naissance').')';
        }   if ($benef->etablissement!= $request->input('etablissement')) {
            $changement .= 'etablissement('.$benef->etablissement.'=>'.$request->input('etablissement').')';
        }
        $benef->nni = $request->input('nni');
        $benef->nom = $request->input('nom');
        $benef->prenom = $request->input('prenom');
        $benef->statut = $request->input('statut');
        $benef->sexe = $request->input('sexe');
        $benef->etablissement = $request->input('etablissement');
        // $benef->num_cnam = $request->input('num_cnam');
        $benef->date_naissance = $request->input('date_naissance');
        if ($request->hasFile('benef_image')){
            $request->file('benef_image')->storePubliclyAs(
                'avatars',
                $request->input('matricule').'.jpg'
            );
        }
        $benef->save();

        $action = 'Modification : Tiers(mat: '.$benef->matricule .' nom: '.$request->input('nom').') changement :'.$changement ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
                'entite' => $benef->matricule,
            ]);
        }

        $request->session()->flash('success', 'Le tiers a été modifier avec succès :)');
        return back()->with('success', ' tiers a été modifier avec succès :)');
    }


    public function destroy(Request $request,$id)
    {
        $benef = Beneficier::with(['couples', 'enfants'])->findOrFail($id);
        if (($benef->couples->isEmpty()) && ($benef->enfants->isEmpty())) {
            $beneficier = Beneficier::find( $id);
            $beneficier->delete();

            $action = 'Suppression : Tiers(mat: '.$benef->matricule.' nom:'.$benef->nom.')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first();
            if (!($user_logged_in->name == 'dev')) {
                # code...
                $log = Logs::create([
                    'userid' => $user_logged_in->id,
                    'user' => $user_logged_in->name,
                    'email' => $user_logged_in->email,
                    'action' => $action,
                    'entite' => $benef->matricule,
                ]);
            }
            $request->session()->flash('success', 'Tiers est supprimé avec succès');
            return redirect()->route('beneficier.index');
        }else{
            //$request->session()->flash('denied', 'benefloyé ne peut pas être supprimer car il ya des dependant(Vider les relations dabord!)');
            return back()->with('denied', 'Tiers ne peut pas être supprimer car il ya des dependants(Vider les relations dabord!)');
        }
    }
}
