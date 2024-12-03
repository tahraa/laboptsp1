<?php

namespace App\Http\Controllers;


use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersImportController extends Controller
{



    public function show(){
        return view('users.importExport');
    }

    public function store(Request $request){

         Excel::import(new UserImport, $request->file);
         return redirect('/')->with('success', 'All good!');
    }





}
