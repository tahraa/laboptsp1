<?php

namespace App\Http\Controllers;


use App\Affaire;
use App\Logs;
use App\Echantillon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class EchantillonController extends Controller
{


   public function create()
    {
        $affaires = Affaire::all();
        return view('echatillon.create', [
            'affaires' => $affaires,
        ]);
    }

    public function store(Request $request)
    {
        $validation = [
            'description' => 'required',
            'num_echantillon' => 'required',
            'employe' => 'required|not_in:vide',
			 'etat' => 'required',
			 
        ];
        $request->validate($validation);

        $Intervenant = new Echantillon();
    

        $emp = Affaire::withCount(['reserves', 'intervenants','rapports','echantillons'])->findOrFail($request->input('employe'));
        $Intervenant-> num_echantillon=$request->input('num_echantillon');
        $Intervenant->description = $request->input('description');
        $Intervenant->etat = $request->input('etat');
		    $Intervenant->num_scelle = $request->input('num_scelle');
			   $Intervenant->datep=$request->input('datep');
        $Intervenant->Affaire_id = $request->input('employe');
        $Intervenant->num_affaire = $emp->num_affaire;
		   $Intervenant->traite = $request->input('traite');
        $Intervenant->periode_conservation = $request->input('periode_conservation');
        $Intervenant->save();

        $action = 'Ajout: Echantillon(num_echantillon:'.$request->input('num_echantillon').' :'. $request->input('num_affaire') .' '.$request->input('description') .')';
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

        return  back()->with('success', 'l’Echantillon a été ajouté avec succès.');
    }




    public function index()
    {
        $user_id = auth()->user()->id;
       // $user_logged_in = \App\User::where(['id' => $user_id])->first();

            $commissariats = DB::table('echantillons')->orderBy('num_affaire','desc')->paginate(1000);

        $count_commissariats= DB::table('echantillons')->count();


        return view(
            'echatillon.index',
            [
                'commissariats' => $commissariats,
                'count_commissariats' => $count_commissariats,
            ]
        );
    }

public function edit($id)
{
    $echantillon = Echantillon::findOrFail($id);
    $affaires = Affaire::all();
    
    return view('echatillon.edit', [
        'echantillon' => $echantillon,
        'affaires' => $affaires,
    ]);
}
public function update(Request $request, $id)
{
 

    // Trouver l'échantillon ou lancer une exception 404
    $echantillon = Echantillon::findOrFail($id);
  
    $echantillon->update([
        'num_echantillon' => $request->input('num_echantillon'),
        'description' => $request->input('description'),
        'etat' => $request->input('etat'),
        'num_scelle' => $request->input('num_scelle'),
        'datep' => $request->input('datep'),
        'traite' => $request->input('traite'),
        'periode_conservation' => $request->input('periode_conservation'),
    ]);

    // Création du log
    $action = 'Mise à jour: Echantillon(num_echantillon:' . $request->input('num_echantillon') . ' : ' . $request->input('description') . ')';
    $user_logged_in = auth()->user();  // Simplifier la récupération de l'utilisateur connecté

    if ($user_logged_in->name != 'dev') {
        Logs::create([
            'userid' => $user_logged_in->id,
            'user' => $user_logged_in->name,
            'email' => $user_logged_in->email,
            'action' => $action,
       
        ]);
    }

    // Redirection vers la page précédente avec un message de succès
    return redirect()->back()->with('success', 'L’Echantillon a été mis à jour avec succès.');
}








}
