<?php

namespace App\Http\Controllers;

use App\Imports\CoupleImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CoupleImportController extends Controller
{
    public function importFrom(){
        return view('couples.form-import');
    }

    public function import(Request $request){
        Excel::import(new CoupleImport, $request->file);
        return redirect('/couples');
    }
}
