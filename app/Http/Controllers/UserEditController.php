<?php

namespace App\Http\Controllers;


use App\Logs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserEditController extends Controller
{
   
    protected function editt($id)
    {
        dd($id);
        $user = User::findOrFail($id);
        return view('users.edit2', [
            'user' => $user
        ]);
    }


    protected function updatee(Request $request, $id)
    {
        $validation = [
            'entred_password' => 'required',
            'nv_password' => 'required',
        ];

        $request->validate($validation);
        $changement ='';
        $user = User::findOrFail($id);
       
        if ($user->name != $request->input('name')) {
            $changement .= 'nom('.$user->name.'=>'.$request->input('name').')';
        }
        if ($user->email != $request->input('email')) {
            $changement .= 'email('.$user->email.'=>'.$request->input('email').')';
        } 
         $user->name = $request->input('name');
        $user->email = $request->input('email'); 

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



}
