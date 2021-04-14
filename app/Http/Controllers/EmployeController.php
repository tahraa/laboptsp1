<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Couple;
use App\Enfant;
use App\Logs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employes = DB::table('employes')->orderBy('id','desc')->paginate(2);
        $employes = DB::table('employes')->orderBy('id','desc')->get();
       
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
            'moreFieldsC.*.nni' => 'required|digits:10|unique:couples|numeric',
            'moreFieldsC.*.nom' => 'required',
            'moreFieldsC.*.prenom' => 'required',
            'moreFieldsC.*.sexe' => 'required',
            'moreFieldsC.*.statut' => 'required',
            'moreFieldsC.*.statut' => 'required',
            'moreFieldsC.*.couple_image' => 'required|image',
            'moreFieldsE.*.nni' => 'exclude_if:genre,0|required|digits:10|unique:couples|numeric',
            'moreFieldsE.*.nom' => 'exclude_if:genre,0|required',
            'moreFieldsE.*.prenom' => 'exclude_if:genre,0|required',
            'moreFieldsE.*.sexe' => 'exclude_if:genre,0|required',
            'moreFieldsE.*.statut' => 'exclude_if:genre,0|required',
            'nni' => 'required|digits:10|unique:employes|numeric' ,
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'matricule' => 'required|digits:5|unique:employes|numeric',
            'statut' => 'required',
            'emp_image' => 'required',
            'date_naissance' => 'required',
        ];
        $request->validate($validation);
        if ($request->hasFile('emp_image')) {
            //$file_path = $request->file('emp_image')->storeAs('avatars', $request->input('matricule'));
            /* Storage::putFileAs(
                'images/', $request->file('emp_image'), $request->input('matricule').'.jpg'
            ); */

            $request->file('emp_image')->storePubliclyAs(
                'avatars',
                $request->input('matricule').'.jpg'
            );
        }
        $emp = Employe::create([
            'nni' => $request->input('nni'),
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'sexe' => $request->input('sexe'),
            'matricule' => $request->input('matricule'),
            'statut' => $request->input('statut'),
            'date_naissance' => $request->input('date_naissance'),
        ]);
        
        foreach ($request->moreFieldsC as $key => $value) {

                $value['couple_image']->storePubliclyAs(
                    'couple_images',
                    $value['nni'].'.jpg'
                );
        
            Couple::create([
                'nni' => $value['nni'],
                'nom' => $value['nom'],
                'prenom' => $value['prenom'],
                'sexe' => $value['sexe'],
                'statut' => $value['statut'],
                'employe_id' => $emp->id,
                'date_naissance' => $value['date_naissance'],
                'date_mariage' => $value['date_mariage'],
            ]);
        }

        if ($request->input('genre') == '1') {
            foreach ($request->moreFieldsE as $key => $value) {
                
                $value['e_image']->storePubliclyAs(
                    'enfant_images',
                    $value['nni'].'.jpg'
                );
                Enfant::create([
                    'nni' => $value['nni'],
                    'nom' => $value['nom'],
                    'prenom' => $value['prenom'],
                    'sexe' => $value['sexe'],
                    'statut' => $value['statut'],
                    'date_naissance' => $value['date_naissance'],
                    'scolarite' => $value['scolarite'],
                    'employe_id' => $emp->id
                ]);
            }
        }

        $related_touched ='';
        if ($request->input('genre') == '1') {
        foreach ($request->moreFieldsE as $key => $value) {
            $related_touched .= ' Enfant(nni:'.$value['nni'].' nom:'.$value['nom'].') ';
        }
        }

        foreach ($request->moreFieldsC as $key => $value) {
            $related_touched .= ' Conjoint(nni'.$value['nni'].' nom'.$value['nom'].') ';
        }
        $action = 'Création : Agent(mat:'.$request->input('matricule').' nom:'.$request->input('nom') .') '. $related_touched;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first(); 

        $log = Logs::create([
            'userid' => $user_logged_in->id,
            'user' => $user_logged_in->name,
            'email' => $user_logged_in->email,
            'action' => $action
        ]);

        return back()->with('success', 'la carnet a été déclarer avec succès :).');
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

        $action = 'Modification : Agent(mat:'.$request->input('matricule').' nom:'.$request->input('nom').') changement :'.$changement ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first(); 

        $log = Logs::create([
            'userid' => $user_logged_in->id,
            'user' => $user_logged_in->name,
            'email' => $user_logged_in->email,
            'action' => $action
        ]);

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

            $action = 'Suppression : Agent(mat:'.$emp->matricule.' nom:'.$emp->nom.')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first(); 
    
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action
            ]);
            $request->session()->flash('success', 'Employé est supprimé avec succès');
            return redirect()->route('employes.index');
        }else{
            //$request->session()->flash('denied', 'Employé ne peut pas être supprimer car il ya des dependant(Vider les relations dabord!)');
            return back()->with('denied', 'Employé ne peut pas être supprimer car il ya des dependant(Vider les relations dabord!)');
        }
    }


    public function search($id)
    {
        return view('employes.search');
    }
}
