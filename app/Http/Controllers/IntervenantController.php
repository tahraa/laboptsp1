<?php

namespace App\Http\Controllers;


use App\Affaire;
use App\Logs;
use App\Intervenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IntervenantController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();

            $Intervenants = DB::table('Intervenants')->orderBy('matricule','desc')->paginate(500);

        $count_Intervenants = DB::table('Intervenants')->count();


        return view(
            'Intervenants.index',
            [
                'Intervenants' => $Intervenants,
                'count_Intervenants' => $count_Intervenants,
            ]
        );
    }

    public function create()
    {
        $affaires = Affaire::all();
        return view('intervenants.create', [
            'affaires' => $affaires,
        ]);
    }


    public function store(Request $request)
    {
        $validation = [
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required',
            'date_intervention' => 'required',
            'employe' => 'required|not_in:vide',
        ];
        $request->validate($validation);

        $Intervenant = new Intervenant();
        $image = '';
        if ($request->hasFile('e_image')) {

            $request->file('e_image')->storePubliclyAs(
                'couple_images',
                $request->input('matricule').'.jpg'
            );
            $image = $request->input('matricule').'.jpg';
            $Intervenant->image = $image;
        }

        $emp = Affaire::withCount(['reserves', 'intervenants','rapports'])->findOrFail($request->input('employe'));
        $Intervenant-> matricule=$request->input('matricule');
        $Intervenant->nom = $request->input('nom');
        $Intervenant->prenom = $request->input('prenom');
        $Intervenant->service = $request->input('service');
        $Intervenant->Affaire_id = $request->input('employe');
        $Intervenant->date_intervention = $request->input('date_intervention');
        $Intervenant->num_affaire = $emp->num_affaire;
        $Intervenant->grade = $request->input('grade');
        $Intervenant->save();

        $action = 'Ajout: Intervenant(matricule:'.$request->input('matricule').' nom:'. $request->input('nom') .' '.$request->input('prenom') .')';
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

        return  back()->with('success', 'l’intervenant a été ajouté avec succès.');
    }


    public function show($id)
    {
        return view('intervenants.show', [
            'enfant' => Intervenant::findOrFail($id),
        ]);
    }

public function destroy($id)
{
    $intervenant = Intervenant::findOrFail($id); // Trouver l'intervenant par son ID

    // Récupérer les informations nécessaires pour le log avant la suppression
    $matricule = $intervenant->matricule;
    $nom = $intervenant->nom;
    $prenom = $intervenant->prenom;

    // Supprimer l'intervenant
    $intervenant->delete();

    // Créer l'action pour le log
    $action = 'Suppression: Intervenant(matricule:'.$matricule.' Nom:'.$nom.' '.$prenom.')';

    // Enregistrer le log
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::find($user_id);

     if ($user_logged_in && $user_logged_in->name !== 'dev') {
        Logs::create([
            'userid' => $user_logged_in->id,
            'user' => $user_logged_in->name,
            'email' => $user_logged_in->email,
            'action' => $action,
            'entite' => $intervenant->num_affaire, // Vérifiez si num_affaire doit être affecté ici
        ]);
      }

    return redirect()->back()->with('success', 'L\'intervenant a été supprimé avec succès.');
}



}
