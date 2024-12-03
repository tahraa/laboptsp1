<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Commiseriat;
use App\Logs;
use Illuminate\Support\Facades\DB;
class CommiseriatController extends Controller
{

    public function create()
    {
        return view('commissariats.create');
    }


    public function store(Request $request)
    {
        $validation = [

            'nom' => 'required',
       

        ];

        $request->validate($validation);

        $emp = Commiseriat::create([
            'nom' => $request->input('nom'),
            'region' => $request->input('region'),
            'contact' => $request->input('contact'),

        ]);

        $action = 'Création : Commissariat(nom:'.$request->input('nom').' DRS : '.$request->input('region').')' ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,
               
            ]);
        }

        return back()->with('success', 'le commissariat a été ajouté avec succès :).');
    }

    public function show($id)
    {
        return view('commissariats.show', [
            'emp' => Commiseriat::with('affaires')->findOrFail($id), ]);
    }



    public function index()
    {
        $user_id = auth()->user()->id;


            $commissariats = DB::table('commiseriats')->orderBy('region','desc')->paginate(50);

        $count_commissariats= DB::table('commiseriats')->count();


        return view(
            'commissariats.index',
            [
                'commissariats' => $commissariats,
                'count_commissariats' => $count_commissariats,
            ]
        );
    }




}
