<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Affaire;
use App\Logs;
use App\Rapport;
use Response;
use Illuminate\Support\Facades\DB;
class RapportController extends Controller
{

    public function create()
    {
        $affaires = Affaire::all();
        return view('rapports.create', [
            'affaires' => $affaires,
        ]);
    }
    public function store(Request $request)
    {
        $validation = [

           // 'pdf' => 'required',
            'affaire' => 'required|not_in:vide',
        ];
        $request->validate($validation);
        $emp = Affaire::withCount(['intervenants','rapports'])->findOrFail($request->input('affaire'));
       if( ($emp->rapports_count >= 1)){
            return back()->with('denied', 'affaire possède déja un document(s), seulement admin peut modifier|ajouter');
        }else{

       $rapport = new Rapport();


   if(  $pdf=$request->file('pdf')){    $n =$pdf->getClientOriginalName();
    $pdf->move('files', $n);
    $rapport->pdf=  $n;}

       $rapport->Affaire_id = $request->input('affaire');
      

   if(  $echantillons= $request->file('echantillons')){
      $n2= $echantillons->getClientOriginalName();
      $echantillons->move('files', $n2);
      $rapport->echantillons =$n2;}
      if(
       $section=$request->file('section')){
       $n3= $section->getClientOriginalName();
       $section->move('files', $n3);
        $rapport->section = $n3;}
         if($methode_analyse = $request->file('methode_analyse')){
            $n4= $methode_analyse->getClientOriginalName();
            $methode_analyse->move('files', $n4);
             $rapport->methode_analyse = $n4;

        }

    if($conclusion = $request->file('conclusion')){
            $n5= $conclusion->getClientOriginalName();
            $conclusion->move('files', $n5);
             $rapport->conclusion = $n5;

        }
        if($f_genotypage = $request->file('f_genotypage')){
            $n6= $f_genotypage->getClientOriginalName();
            $f_genotypage->move('files', $n6);
             $rapport->f_genotypage = $n6;

        }
        if($f_Q = $request->file('f_Q')){
            $n7= $f_Q->getClientOriginalName();
            $f_Q->move('files', $n7);
             $rapport->f_Q = $n7;
        }

        if($f_v_scelle= $request->file('f_v_scelle')){
            $n9= $f_v_scelle->getClientOriginalName();
            $f_v_scelle->move('files', $n9);
             $rapport->f_v_scelle = $n9;
        }


        if($f_p= $request->file('f_p')){
            $n8= $f_p->getClientOriginalName();
            $f_p->move('files', $n8);
             $rapport->f_p = $n8;
        }

        if($f_v_a_resultat= $request->file('f_v_a_resultat')){
            $n11= $f_v_a_resultat->getClientOriginalName();
            $f_v_a_resultat->move('files', $n11);
             $rapport->f_v_a_resultat = $n11;
        }
        if($decharge= $request->file('decharge')){
            $n12= $decharge->getClientOriginalName();
            $decharge->move('files', $n12);
             $rapport->decharge = $n12;
        }



        if($p= $request->file('p')){
            $n13= $p->getClientOriginalName();
            $p->move('files', $n13);
             $rapport->p = $n13;
        }



        if($c= $request->file('c')){
            $n14= $c->getClientOriginalName();
            $c->move('files', $n14);
             $rapport->c = $n14;
        }


        if($d= $request->file('d')){
            $n15= $d->getClientOriginalName();
            $d->move('files', $n15);
             $rapport->d = $n15;
        }




       if($rapport_medecin_legiste= $request->file('rapport_medecin_legiste')){
            $m1= $rapport_medecin_legiste->getClientOriginalName();
            $rapport_medecin_legiste->move('files', $m1);
             $rapport->rapport_medecin_legiste = $m1;
        }

    if($rapport_emp = $request->file('rapport_emp')){
            $m2= $rapport_emp->getClientOriginalName();
            $rapport_emp->move('files', $m2);
             $rapport->rapport_emp = $m2;

        }
		    if($rapport_balistique = $request->file('rapport_balistique')){
            $m3= $rapport_balistique->getClientOriginalName();
            $rapport_balistique->move('files', $m3);
             $rapport->rapport_balistique = $m3;

        }


       $rapport->num_affaire = $emp->num_affaire;
       $rapport->save();
        $action = 'Ajout du Document(N°affaire concernée: '. $emp->num_affaire.')';
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
                'entite' =>$rapport->num_affaire = $emp->num_affaire,
            ]);
        }

    }

    return back()->with('success', 'Ajout ce fait avec succès :).');

}



public function edit($id)
{
    $enfant = Rapport::findOrFail($id);
    return view('rapports.edit', [
        'enfant' => $enfant
    ]);
}
public function update(Request $request, $id)
{
}

public function index()
{

        $enfants = DB::table('rapports')->orderBy('num_affaire','desc')->paginate(1000);

    $count_enfants = DB::table('rapports')->count();


    return view(
        'rapports.index',
        [
            'enfants' => $enfants,
            'count_enfants' => $count_enfants,
        ]
    );
}



}
