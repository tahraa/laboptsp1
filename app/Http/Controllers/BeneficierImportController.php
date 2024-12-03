<?php

namespace App\Http\Controllers;

use App\Imports\BeneficiersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class BeneficierImportController extends Controller
{
    public function importFrom(){
        return view('beneficiers.form-import');
    }


    public function import(Request $request){
        Excel::import(new BeneficiersImport, $request->file);
        return redirect('/beneficier');
    }
}

