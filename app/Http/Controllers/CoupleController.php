<?php

namespace App\Http\Controllers;

use App\Couple;
use App\Employe;
use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoupleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couples = DB::table('couples')->orderBy('id','desc')->get();
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
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'statut' => 'required',
            'c_image' => 'required',
            'employe' => 'required',
            'date_mariage' => 'required',
            'date_naissance' => 'required',
        ];
        $request->validate($validation);
        // $emp = Employe::find($request->input('employe'));
        $emp = Employe::withCount(['couples', 'enfants'])->findOrFail($request->input('employe'));
        //$emp->couples_count;
        if($emp->couples_count >= 2){
            return back()->with('denied', 'l\'employé possède déja la limite');
        }else{

            if ($request->hasFile('c_image')) {

                $request->file('c_image')->storePubliclyAs(
                    'couple_images',
                    $request->input('nni').'.jpg'
                );
            }

            $couple = Couple::create([
                'nni' => $request->input('nni'),
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'sexe' => $request->input('sexe'),
                'statut' => $request->input('statut'),
                'date_mariage' => $request->input('date_mariage'),
                'date_naissance' => $request->input('date_naissance'),
                'employe_id' => $request->input('employe')
            ]);
            
            $action = 'Création : Conjoint(nom:'.$request->input('nom').' nni:'.$request->input('nni') .' emp_id:'. $request->input('employe') .')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first(); 
    
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action
            ]);
    
            return back()->with('success', 'Conjoint(e) déclarer avec succès :).');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            'sexe' => 'required',
            'statut' => 'required'
        ];
        $request->validate($validation);
        $changement ='';
        $couple = Couple::findOrFail($id);
        if ($couple->nni != $request->input('nni')) {
            $changement .= 'nni('.$couple->nni.'=>'.$request->input('nni').')'; 
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
        if ($couple->sexe != $request->input('sexe')) {
            $changement .= 'sexe('.$couple->sexe.'=>'.$request->input('sexe').')'; 
        }
        $couple->nni = $request->input('nni');
        $couple->nom = $request->input('nom');
        $couple->prenom = $request->input('prenom');
        $couple->statut = $request->input('statut');
        $couple->sexe = $request->input('sexe');
        if ($request->hasFile('c_image')){
            $request->file('c_image')->storePubliclyAs(
                'couple_images',
                $request->input('nni').'.jpg'
            );
        }
        $couple->save();

        $action = 'Modification : Conjoint(nom:'.$request->input('nom').' nni:'.$request->input('nni').') changement :'.$changement ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first(); 

        $log = Logs::create([
            'userid' => $user_logged_in->id,
            'user' => $user_logged_in->name,
            'email' => $user_logged_in->email,
            'action' => $action
        ]);

        $request->session()->flash('success', 'L\' employé a été modifier avec succès :)');
        return back()->with('success', 'Conjoint a été modifier avec succès :)');
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
        $action = 'Suppression : Conjoint(nni:'.$couple->nni.' nom:'.$couple->nom.')';
            $user_id = auth()->user()->id;
            $user_logged_in = \App\User::where(['id' => $user_id])->first(); 
    
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action
            ]);
        $request->session()->flash('success', 'Conjoint(e) est supprimé(e) avec succès');
        return redirect()->route('couples.index');
    }
}
