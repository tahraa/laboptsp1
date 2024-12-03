<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Couple;
use App\Enfant;
use App\Logs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class EmpOneController extends Controller
{

    public function index()
    {

    }


    public function create()
    {
        return view('empone.create');
    }


    public function store(Request $request)
    {
        $validation = [
            'nni' => 'required|digits:10|unique:employes|numeric' ,
            'num_cnam' => 'required|digits:8|unique:employes|numeric',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'matricule' => 'required|digits:5|unique:employes|numeric',
            'statut' => 'required',
            'emp_image' => 'required',
            'situation_civile' => 'required',
            'etablissement' => 'required',
            'service' => 'required|digits:6|numeric',
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


        $emp = Employe::create([
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
        $action = 'Création : Agent(mat:'.$request->input('matricule').' nom:'.$request->input('nom').')' ;
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

        return back()->with('success', 'le livret a été créé avec succès :).');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

    }


    public function search($id)
    {

    }
}
