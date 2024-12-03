<?php

namespace App\Http\Controllers;

use App\Commiseriat;
use Illuminate\Http\Request;
use App\Affaire;
use App\Logs;
use App\Intervenant;
use App\Reserve;
use App\Echantillon;
use Illuminate\Support\Facades\DB;
class AffaireController extends Controller
{

    public function create()
    {
        $c = Commiseriat::all();
        return view('employes.create', [
            'c' =>  $c,
        ]);
    }

    public function store(Request $request)
    {
        $validation = [
            'genre' => 'required',
           'num_affaire' => 'required|numeric|unique:affaires',
            'type' => 'required',
            'date' => 'required',
            'num_soit => numeric',
            'employe' => 'required|not_in:vide',
            'moreFieldsC.*.matricule' => 'required',
            'moreFieldsC.*.nom' => 'required',
            'moreFieldsC.*.prenom' => 'required',
            'moreFieldsC.*.grade' => 'required',
            'moreFieldsC.*.date_intervention' => 'required',

          
            'moreFieldsE.*.etat' =>  'exclude_if:genre,0',
            'moreFieldsE.*.description' =>  'exclude_if:genre,0'
        ];

        $request->validate($validation);
        $affaire = new Affaire();
        $emp = Commiseriat::withCount(['affaires'])->findOrFail($request->input('employe'));
        $affaire->num_affaire=$request->input('num_affaire');
		        $affaire->num_rapport=$request->input('num_rapport');
        $affaire->type=$request->input('type');
        $affaire->commiseriat_id = $request->input('employe');
        $affaire->num_affaire_c=$request->input('num_affaire_c');
        $affaire->lieu_crime=$request->input('lieu_crime');
		 $affaire->victim=$request->input('victim');
        $affaire->reference=$request->input('reference');
		      $affaire->periode=$request->input('periode');
        $affaire->num_soit=$request->input('num_soit');
		        $affaire->lieu_prelevement=$request->input('lieu_prelevement');
				        $affaire->date_prelevement=$request->input('date_prelevement');
        $affaire->partie_declarent = $emp->nom." DRS ".$emp->region;
        $affaire->date=$request->input('date');
        $affaire->save();

        foreach ($request->moreFieldsC as $key => $value) {
            $Intervenant = new Intervenant();

            $value['e_image']->storePubliclyAs(
                'couple_images',
                $value['matricule'].'.jpg'
            );
            $image = $value['matricule'].'.jpg';


        $Intervenant->image = $image;
        $Intervenant-> matricule=$value['matricule'];
        $Intervenant->nom =  $value['nom'];
        $Intervenant->prenom = $value['prenom'];

        $Intervenant->Affaire_id = $affaire->id;
        $Intervenant->date_intervention = $value['date_intervention'];
        $Intervenant->num_affaire = $affaire->num_affaire;
        $Intervenant->grade =  $value['grade'];
        $Intervenant->save();


}

if ($request->input('genre') == '1') {
    foreach ($request->moreFieldsE as $key => $value) {

    $r = new Echantillon();

    $r->Affaire_id = $affaire->id;

    $r->periode_conservation=$value['periode_conservation'];
   $r->num_echantillon=$value['num_echantillon'];
      $r->num_scelle=$value['num_scelle'];
    $r->etat=$value['etat'];

    $r->description=$value['description'];
    $r->num_affaire = $affaire->num_affaire;
	   $r->datep =$affaire->date; 
    $r->save();

    }}




$related_touched ='';
if ($request->input('genre') == '1') {
foreach ($request->moreFieldsE as $key => $value) {
    $related_touched .= ' Echantillon(s):  '.$value['description'] .')';
}
}

foreach ($request->moreFieldsC as $key => $value) {
    $related_touched .= ' Intervenant(Matricule: '.$value['matricule'].' nom: '.$value['nom']. '  prenom: '.$value['prenom'].') ';
}

 $action = 'Création : Affaire(N°affaire:'.$request->input('num_affaire').' ,'.'type: '.$request->input('type').')'. $related_touched ;
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

    public function index()
    {
    $employes = DB::table('affaires')->orderBy('date','desc')->paginate(500);
    $count_employes = DB::table('affaires')->count();
    return view(
        'employes.index',
        [
            'employes' => $employes,
            'count_employes' => $count_employes,
        ]

    );

    }
 
    public function edit($id)
    {  $c = Commiseriat::all();
        $employe =  Affaire::withCount(['intervenants', 'rapports','reserves'])->findOrFail($id);
        return view('employes.edit', [
            'employe' => $employe,
            'c' =>  $c,
        ]);






}
public function show($id)
{
    // Charger l'affaire avec les intervenants, rapports et réserves associés
    $employe = Affaire::with(['intervenants', 'rapports', 'reserves', 'echantillons'])->findOrFail($id);

    return view('employes.show', [
        'employe' => $employe,
    ]);
}


public function update(Request $request, $id)
{
    $validation = [

        'type' => 'required',
        'num_affaire' => 'required|digits:6|numeric',
        'reference' => 'required',
        'date' => 'required'

    ];
    $request->validate($validation);
    $changement ='';
    $emp = Affaire::findOrFail($id);
    if ($emp->type!= $request->input('type')) {
        $changement .= 'type('.$emp->type.'=>'.$request->input('type').')';
    }

    if ($emp->num_affaire != $request->input('num_affaire')) {
        $changement .= 'num_affaire('.$emp->num_affaire.'=>'.$request->input('num_affaire').')';
    }
   if ($emp->num_affaire_c != $request->input('num_affaire_c')) {
        $changement .= 'num_affaire_dans_le commissariat('.$emp->num_affaire_c.'=>'.$request->input('num_affaire_c').')';
    }
	  if ($emp->num_rapport != $request->input('num_rapport')) {
        $changement .= 'Num_Rapport('.$emp->num_rapport.'=>'.$request->input('num_rapport').')';
    }
    if ($emp->reference!= $request->input('reference')) {
        $changement .= 'reference('.$emp->reference.'=>'.$request->input('reference').')';
    }
    if ($emp->date_prelevement != $request->input('date_prelevement')) {
        $changement .= 'date_prelevement('.$emp->date_prelevement.'=>'.$request->input('date_prelevement').')';
    }
    if ($emp->lieu_prelevement != $request->input('lieu_prelevement')) {
        $changement .= 'lieu_prelevement('.$emp->lieu_prelevement.'=>'.$request->input('lieu_prelevement').')';
    }

    if ($emp->date != $request->input('date')) {
        $changement .= 'date_affaire('.$emp->date.'=>'.$request->input('date').')';
    }
    if ($emp->num_soit != $request->input('num_soit')) {
        $changement .= 'Numero_soit_transmis('.$emp->num_soit.'=>'.$request->input('num_soit').')';
    }
    if ($emp->lieu_crime!= $request->input('lieu_crime')) {
        $changement .= 'lieu_d\'infraction('.$emp->lieu_crime.'=>'.$request->input('lieu_crime').')';
		 }
		    if ($emp->resultat!= $request->input('resultat')) {
        $changement .= 'Resultat('.$emp->resultat.'=>'.$request->input('resultat').')';
    }
	    if ($emp->periode!= $request->input('periode')) {
        $changement .= 'date et periode d\'intervention('.$emp->periode.'=>'.$request->input('periode').')';
		
    }
	   if ($emp->victim!= $request->input('victim')) {
        $changement .= 'victim('.$emp->victim.'=>'.$request->input('victim').')';
		
    } 
	
    $emp->type = $request->input('type');
    $emp->num_affaire = $request->input('num_affaire');
    $emp->reference = $request->input('reference');
    $emp->date_prelevement = $request->input('date_prelevement');
    $emp->lieu_prelevement = $request->input('lieu_prelevement');
    $emp->date = $request->input('date');
    $emp->lieu_crime = $request->input('lieu_crime');
	$emp->periode = $request->input('periode');
    $emp->num_affaire_c = $request->input('num_affaire_c');
	 $emp->num_soit = $request->input('num_soit');
	  $emp->resultat = $request->input('resultat');
	 	 $emp->num_rapport = $request->input('num_rapport');
		  	 $emp->victim = $request->input('victim');
    $emp->save();

    $action = 'Modification : Affaire(Num: '.$request->input('num_affaire').' Type: '.$request->input('type').') changement :'.$changement ;
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
    if (!($user_logged_in->name == 'dev')) {
        # code...
        $log = Logs::create([
            'userid' => $user_logged_in->id,
            'user' => $user_logged_in->name,
            'email' => $user_logged_in->email,
            'action' => $action,
            'entite' => $emp->num_affaire,
        ]);
    }

    $request->session()->flash('success', 'L\' affaire a été modifier avec succès :)');
    return back()->with('success', 'L\' affaire a été modifier avec succès :)');
}


public function destroy(Request $request, $id)
{
    $emp =  Affaire::with(['intervenants', 'rapports','reserves','echantillons' ,'geneticProfiles'])->findOrFail($id);
    if (($emp->intervenants->isEmpty()) && ($emp->rapports->isEmpty()) && ($emp->echantillons->isEmpty()) && ($emp->reserves->isEmpty()) && ($emp->geneticProfiles->isEmpty())){
        $employe = Affaire::find( $id);
        $employe->delete();

        $action = 'Suppression : Affaire(Num_Affaire: '.$emp->num_affaire.'Date: '.$emp->date.' Service Demendeur:'.$emp->partie_declarent.')';
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
                'entite' => $emp->num_affaire,
            ]);
        }
        $request->session()->flash('success', 'Affaire a été supprimé avec succès');
        return redirect()->route('employes.index');
    }else{
        return back()->with('denied', 'Affaire ne peut pas être supprimer car il a des dépendants(Vider les rélations tout dabord!)');
    }
}
}
