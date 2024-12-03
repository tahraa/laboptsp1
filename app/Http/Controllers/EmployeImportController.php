<?php

namespace App\Http\Controllers;

use App\Imports\EmployeImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class EmployeImportController extends Controller
{
    public function importFrom(){
        return view('employes.form-import');
    }


    public function import(Request $request){
        Excel::import(new EmployeImport, $request->file);
        return redirect('/employes');
    }
}

