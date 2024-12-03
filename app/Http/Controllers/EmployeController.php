<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Couple;
use App\Enfant;
use App\Imports\EmployeImport;
use App\Logs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EmployeController extends Controller
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
            $employes = DB::table('employes')->where('etablissement', $user_logged_in['etablissement'])->orderBy('matricule','desc')->paginate(500);
        }else{
            $employes = DB::table('employes')->orderBy('matricule','desc')->paginate(500);
        }
     
        $count_employes = DB::table('employes')->count();
        return view(
            'employes.index',
            [
                'employes' => $employes,
                'count_employes' => $count_employes,
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
        return view('employes.create');
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
            /* 'moreFields.*.title' => 'required',
            'moreFields.*.matricule' => 'required', */
            'genre' => 'required',
            'moreFieldsC.*.nni' => 'required|digits:10|unique:enfants|numeric',
            'moreFieldsC.*.num_cnam' => 'exclude_if:genre,0|required|digits:8|unique:enfants|numeric',
            'moreFieldsC.*.nom' => 'required',
            'moreFieldsC.*.prenom' => 'required',
            // 'moreFieldsC.*.sexe' => 'required',
            'moreFieldsC.*.statut' => 'required',
            'moreFieldsC.*.statut' => 'required',
            'moreFieldsC.*.couple_image' => 'required|image',
            'moreFieldsE.*.nni' => 'exclude_if:genre,0|required|digits:10|unique:couples|numeric',
            'moreFieldsE.*.num_cnam' => 'exclude_if:genre,0|required|digits:8|unique:couples|numeric',
            'moreFieldsE.*.nom' => 'exclude_if:genre,0|required',
            'moreFieldsE.*.prenom' => 'exclude_if:genre,0|required',
            'moreFieldsE.*.sexe' => 'exclude_if:genre,0|required',
            'moreFieldsE.*.statut' => 'exclude_if:genre,0|required',
            'nni' => 'required|digits:10|unique:employes|numeric' ,
            'num_cnam' => 'required|digits:8|unique:employes|numeric' ,
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'matricule' => 'required|digits:5|unique:employes|numeric',
            'statut' => 'required',
            'emp_image' => 'required',
            'date_naissance' => 'required',
            'etablissement' => 'required',
            'service' => 'required|digits:6|numeric',
        ];
        $request->validate($validation);
        $image='';
        $imageC='';
        $imageE='';
        if ($request->hasFile('emp_image')) {
            //$file_path = $request->file('emp_image')->storeAs('avatars', $request->input('matricule'));
            /* Storage::putFileAs(
                'images/', $request->file('emp_image'), $request->input('matricule').'.jpg'
            ); */

            $request->file('emp_image')->storePubliclyAs(
                'avatars',
                $request->input('matricule').'.jpg'
            );
            $image = $request->input('matricule');
        }
        $emp = Employe::create([
            'nni' => $request->input('nni'),
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'sexe' => $request->input('sexe'),
            'num_cnam' => $request->input('num_cnam'),
            'matricule' => $request->input('matricule'),
            'statut' => $request->input('statut'),
            'situation_civile' => 'Marié',
            'service' => $request->input('service'),
            'etablissement' => $request->input('etablissement'),
            'date_naissance' => $request->input('date_naissance'),
            'image' => $image,
        ]);

        foreach ($request->moreFieldsC as $key => $value) {

                $value['couple_image']->storePubliclyAs(
                    'couple_images',
                    $value['nni'].'.jpg'

                );
                $imageC= $value['nni'].'.jpg';
                // dd('Image C '.$imageC);
                // $emp = Employe::withCount(['couples', 'enfants'])->findOrFail($request->input('employe'));
                $sexe = ($emp->sexe == 'masculin') ? 'feminin' : 'masculin';
            Couple::create([
                'sexe' => $sexe,
                'nni' => $value['nni'],
                'nom' => $value['nom'],
                'prenom' => $value['prenom'],
                // 'sexe' => $value['sexe'],
                'num_cnam' => $value['num_cnam'],
                'statut' => $value['statut'],
                'employe_id' => $emp->id,
                'date_naissance' => $value['date_naissance'],
                'date_mariage' => $value['date_mariage'],
                'etablissement' => $request->input('etablissement'),
                'situation_civile' => 'Marié',
                'type' => 'Conjoint',
                'service' => $request->input('service'),
                'matricule' => $request->input('matricule'),
                'image' => $imageC,
            ]);
        }

        if ($request->input('genre') == '1') {
            foreach ($request->moreFieldsE as $key => $value) {

                $value['e_image']->storePubliclyAs(
                    'enfant_images',
                    $value['nni'].'.jpg'
                );
                $imageE = $value['nni'].'.jpg';




                Enfant::create([
                    'nni' => $value['nni'],
                    'nom' => $value['nom'],
                    'prenom' => $value['prenom'],
                    'sexe' => $value['sexe'],
                    'num_cnam' => $value['num_cnam'],
                    'statut' => $value['statut'],
                    'date_naissance' => $value['date_naissance'],
                    'etablissement' => $request->input('etablissement'),
                    'scolarite' => $value['scolarite'],
                    'employe_id' => $emp->id,
                    'type' => 'Enfant',
                    'service' => $request->input('service'),
                    'matricule' => $request->input('matricule'),
                    'handicap' => false,
                    'image' => $imageE,
                ]);
            }
        }

        $related_touched ='';
        if ($request->input('genre') == '1') {
        foreach ($request->moreFieldsE as $key => $value) {
            $related_touched .= ' Enfant(prenom: '.$value['prenom'].' nom: '.$value['nom'].') ';
        }
        }

        foreach ($request->moreFieldsC as $key => $value) {
            $related_touched .= ' Conjoint(prenom: '.$value['prenom'].' nom: '.$value['nom'].') ';
        }
        $action = 'Création : Agent(mat:'.$request->input('matricule').' nom:'.$request->input('prenom').' '.$request->input('nom').') '. $related_touched;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
                'entite' => $emp->matricule,
            ]);
        }

        return   redirect()->route('employes.index')->with('success', 'le livret a été créé avec succès :).');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('employes.show', [
            'employe' => Employe::with(['couples', 'enfants'])->findOrFail($id),
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
        /* $posts = App\Post::withCount('comments')->get();

        foreach ($posts as $post) {
            echo $post->comments_count;
        } */
        $employe = Employe::withCount(['couples', 'enfants'])->findOrFail($id);
        return view('employes.edit', [
            'employe' => $employe
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
            'matricule' => 'required|digits:5|numeric',
            'statut' => 'required',
            'date_naissance' => 'required'
        ];
        $request->validate($validation);
        $changement ='';
        $emp = Employe::findOrFail($id);
        if ($emp->nni != $request->input('nni')) {
            $changement .= 'nni('.$emp->nni.'=>'.$request->input('nni').')';
        }
        /* if ($emp->nni != $request->input('num_cnam')) {
            $changement .= 'num_cnam('.$emp->nni.'=>'.$request->input('num_cnam').')';
        } */
        if ($emp->matricule != $request->input('matricule')) {
            $changement .= 'matricule('.$emp->matricule.'=>'.$request->input('matricule').')';
        }
        if ($emp->prenom != $request->input('prenom')) {
            $changement .= 'prenom('.$emp->prenom.'=>'.$request->input('prenom').')';
        }
        if ($emp->nom != $request->input('nom')) {
            $changement .= 'nom('.$emp->nom.'=>'.$request->input('nom').')';
        }
        if ($emp->statut != $request->input('statut')) {
            $changement .= 'statut('.$emp->statut.'=>'.$request->input('statut').')';
        }
        if ($emp->sexe != $request->input('sexe')) {
            $changement .= 'sexe('.$emp->sexe.'=>'.$request->input('sexe').')';
        }
        if ($emp->date_naissance != $request->input('date_naissance')) {
            $changement .= 'date_naissance('.$emp->date_naissance.'=>'.$request->input('date_naissance').')';
        }
        $emp->nni = $request->input('nni');
        $emp->nom = $request->input('nom');
        $emp->prenom = $request->input('prenom');
        $emp->statut = $request->input('statut');
        $emp->sexe = $request->input('sexe');
        $emp->matricule = $request->input('matricule');
        $emp->date_naissance = $request->input('date_naissance');
        if ($request->hasFile('emp_image')){
            $request->file('emp_image')->storePubliclyAs(
                'avatars',
                $request->input('matricule').'.jpg'
            );
        }
        $emp->save();

        $action = 'Modification : Agent(mat: '.$request->input('matricule').' nom: '.$request->input('nom').') changement :'.$changement ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
                'entite' => $emp->matricule,
            ]);
        }

        $request->session()->flash('success', 'L\' employé a été modifier avec succès :)');
        return back()->with('success', 'L\' employé a été modifier avec succès :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //$c = $count_couples = DB::table('couples')->count();
        //$e = $count_enfants = DB::table('enfants')->count();
        $emp = Employe::with(['couples', 'enfants'])->findOrFail($id);
        if (($emp->couples->isEmpty()) && ($emp->enfants->isEmpty())) {
            $employe = Employe::find( $id);
            $employe->delete();

            $action = 'Suppression : Agent(mat: '.$emp->matricule.' nom:'.$emp->nom.')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first();
            if (!($user_logged_in->name == 'dev')) {
                # code...
                $log = Logs::create([
                    'userid' => $user_logged_in->id,
                    'user' => $user_logged_in->name,
                    'email' => $user_logged_in->email,
                    'action' => $action,
                    'entite' => $emp->matricule,
                ]);
            }
            $request->session()->flash('success', 'Employé a été supprimé avec succès');
            return redirect()->route('employes.index');
        }else{
            //$request->session()->flash('denied', 'Employé ne peut pas être supprimer car il ya des dependant(Vider les relations dabord!)');
            return back()->with('denied', 'Employé ne peut pas être supprimer car il ya des dependant(Vider les relations dabord!)');
        }
    }


    public function search($id){
        return view('employes.search');
    }


}
