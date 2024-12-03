<?php

namespace App\Http\Controllers;

use App\Logs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->where('name', '!=', 'dev')->orderBy('id','desc')->get();
        $count_users = DB::table('users')->count();
        return view(
            'users.index',
            [
                'users' => $users,
                'count_users' => $count_users,
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
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* public function store(Request $request)
    {
        //
    } */

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:users',
            'email'=> 'required|unique:users',
            'password'=> 'required|min:8',
            'password_confirmation'=> 'required|same:password',
            'profil'=> 'required',
            'etablissement'=> 'required',
        ]);
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'profile' => $request->input('profil'),
            'etablissement' => $request->input('etablissement'),
            'password' => Hash::make($request->input('password')),
        ]);

        $action = 'Création : User(nom:'.$request->input('name'). ' email:'.$request->input('email') .' profil:'. $request->input('profil') .')';
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action,

                // 'entite'=> $entite,
            ]);
        }
        return back()->with('success', 'l\'utilisateur a été crée avec succès :).');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show', [
            'user' => User::findOrFail($id),
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
        $user = User::findOrFail($id);
        return view('users.edit', [
            'user' => $user
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
            'entred_password' => 'required',
            'nv_password' => 'required',
        ];

        $request->validate($validation);
        $changement ='';
        $user = User::findOrFail($id);
        // dd($user->password);
        /* if ($user->name != $request->input('name')) {
            $changement .= 'nom('.$user->name.'=>'.$request->input('name').')';
        }
        if ($user->email != $request->input('email')) {
            $changement .= 'email('.$user->email.'=>'.$request->input('email').')';
        } */
        /* $user->name = $request->input('name');
        $user->email = $request->input('email'); */

        if (Hash::check($request->input('entred_password'), $user->password)) {
            $user->password = Hash::make($request->input('nv_password'));
            
        }else{
                return back()->with('denied', 'L\' ancien mot de passe est incorrect!)');
        }
           $changement .= 'password('.$user->password.'=>'.Hash::make($request->input('password')).')';
    

        $user->save();

        $action = 'Modification : User(nom:'.$request->input('name').' email:'.$request->input('email').') changement :'.$changement ;
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action
            ]);
        }
        $request->session()->flash('success', 'L\' utilisateur a été modifier avec succès :)');
        return back()->with('success', 'L\' utilisateur a été modifier avec succès :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = user::findOrFail($id);
        $user->delete(); // OU Post::destroy($id);
        $action = 'Suppression : User(nom:'.$user->name.' email:'.$user->email.')';
        $user_id = auth()->user()->id;
        $user_logged_in = \App\User::where(['id' => $user_id])->first();
        if (!($user_logged_in->name == 'dev')) {
            # code...
            $log = Logs::create([
                'userid' => $user_logged_in->id,
                'user' => $user_logged_in->name,
                'email' => $user_logged_in->email,
                'action' => $action
            ]);
        }
        $request->session()->flash('success', 'L\'utilisateur est supprimés avec succès');
        return redirect()->route('users.index');
    }
}
