<?php

namespace App\Http\Controllers;

use App\Imports\EnfantImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EnfantImportController extends Controller
{
    public function importFrom(){
        return view('enfants.form-import');
    }

    public function import(Request $request){
        Excel::import(new EnfantImport, $request->file);
        return redirect('/enfants');
    }
}
