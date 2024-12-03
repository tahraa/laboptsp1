<?php

namespace App\Http\Controllers;

use App\Couple;
use App\Employe;
use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoupleController extends Controller
{

    public function index()
    {
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if($user_logged_in['profile'] == 'profil2'){
            $couples = DB::table('couples')->where('etablissement', $user_logged_in['etablissement'])->orderBy('matricule','desc')->paginate(500);
        }else{
            $couples = DB::table('couples')->orderBy('matricule','desc')->paginate(500);
        }
        
        $count_couples = DB::table('couples')->count();
        return view(
            'couples.index',
            [
                'couples' => $couples,
                'count_couples' => $count_couples,
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
        return view('couples.create', [
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
            'num_cnam' => 'required|digits:8|unique:couples|numeric' ,
            'nom' => 'required',
            'prenom' => 'required',
            'statut' => 'required',
            'c_image' => 'required',
            'employe' => 'required|not_in:vide',
            'date_mariage' => 'required',
            'date_naissance' => 'required',
        ];
        $request->validate($validation);
        // $emp = Employe::find($request->input('employe'));
        $emp = Employe::withCount(['couples', 'enfants'])->findOrFail($request->input('employe'));
        $sexe = ($emp->sexe == 'masculin') ? 'feminin' : 'masculin';
        //$emp->couples_count;
        if( ($emp->couples_count >= 2 && $emp->sexe == 'masculin') || ($emp->couples_count >= 1 && $emp->sexe == 'feminin') ){
            return back()->with('denied', 'l\'agent possède déja la limite');
        }else{
            /*   if($emp->sexe='masculin') { */
            $couple = new Couple();
            if ($request->hasFile('c_image')) {

                $request->file('c_image')->storePubliclyAs(
                    'couple_images',
                    $request->input('nni').'.jpg'
                );
                $image = $request->input('nni').'.jpg';
                $couple->image = $image;
            }

            $couple->nni = $request->input('nni');
            $couple->nom = $request->input('nom');
            $couple->prenom = $request->input('prenom');
            $couple->num_cnam = $request->input('num_cnam');
            // $couple->sexe = !($emp->sexe);
            $couple->sexe = $sexe;
            $couple->statut = $request->input('statut');
            $couple->date_mariage = $request->input('date_mariage');
            $couple->date_naissance = $request->input('date_naissance');
            $couple->employe_id = $request->input('employe');
            $couple->matricule = $emp->matricule;
            $couple->situation_civile = 'Marié';
            $couple->service = $emp->service;
            $couple->etablissement = $emp->etablissement;
            $couple->type = 'Conjoint';

            $couple->save();


            $action = 'Création : Conjoint(nom:'.$request->input('nom').' '.$request->input('prenom') .')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first();
            if (!($user_logged_in->name == 'dev')) {
                # code...
                $log = Logs::create([
                    'userid' => $user_logged_in->id,
                    'user' => $user_logged_in->name,
                    'email' => $user_logged_in->email,
                    'action' => $action,
                    'entite' =>  $couple->matricule,
                ]);
            }

            return back()->with('success', 'le conjoint a été créé avec succès :).');
        }

    }

    public function show($id)
    {
        return view('couples.show', [
            'couple' => Couple::findOrFail($id),
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
        $couple = Couple::findOrFail($id);
        return view('couples.edit', [
            'couple' => $couple
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
            'statut' => 'required'
        ];
        $request->validate($validation);
        $changement ='';
        $couple = Couple::findOrFail($id);
        if ($couple->nni != $request->input('nni')) {
            $changement .= 'nni('.$couple->nni.'=>'.$request->input('nni').')';
        }
        if ($couple->nni != $request->input('num_cnam')) {
            $changement .= 'num_cnam('.$couple->nni.'=>'.$request->input('num_cnam').')';
        }
        if ($couple->nom != $request->input('nom')) {
            $changement .= 'nom('.$couple->nom.'=>'.$request->input('nom').')';
        }
        if ($couple->prenom != $request->input('prenom')) {
            $changement .= 'prenom('.$couple->prenom.'=>'.$request->input('prenom').')';
        }
        if ($couple->statut != $request->input('statut')) {
            $changement .= 'statut('.$couple->statut.'=>'.$request->input('statut').')';
        }
        // if ($couple->sexe != $request->input('sexe')) {
        //     $changement .= 'sexe('.$couple->sexe.'=>'.$request->input('sexe').')';
        // }
        $couple->nni = $request->input('nni');
        $couple->nom = $request->input('nom');
        $couple->prenom = $request->input('prenom');
        $couple->statut = $request->input('statut');
      /*   $couple->sexe = $request->input('sexe'); */
        // $couple->num_cnam = $request->input('num_cnam');
        // $image = '';
        if ($request->hasFile('c_image')){
            $request->file('c_image')->storePubliclyAs(
                'couple_images',
                $request->input('nni').'.jpg'
            );
            $image = $request->input('nni').'.jpg';
            $couple->image = $image;
        }
        $couple->save();

        $action = 'Modification : Conjoint(nom:'.$request->input('nom').' '.$request->input('prenom').') changement :'.$changement ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
                'entite' => $couple->matricule,
            ]);
        }

        $request->session()->flash('success', 'Conjoint a été modifié avec succès :)');
        return back()->with('success', 'Conjoint a été modifié avec succès :)');
        //return redirect()->route('couples.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $couple = Couple::find($id);
        $couple->delete(); // OU Post::destroy($id);
        $action = 'Suppression : Conjoint(nom: '.$couple->nom.' '.$couple->prenom.')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first();
            if (!($user_logged_in->name == 'dev')) {
                # code...
                $log = Logs::create([
                    'userid' => $user_logged_in->id,
                    'user' => $user_logged_in->name,
                    'email' => $user_logged_in->email,
                    'action' => $action,
                    'entite' => $couple->matricule,
                ]);
            }
        $request->session()->flash('success', 'Conjoint(e) est supprimé(e) avec succès');
        return redirect()->route('couples.index');
    }
}
