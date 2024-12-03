<?php

namespace App\Http\Controllers;

use App\Imports\EnfantbImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EnfantbImportController extends Controller
{
    public function importFrom(){
        return view('enfantsB.form-import');
    }

    public function import(Request $request){
        Excel::import(new EnfantbImport, $request->file);
        return redirect('/enfantsB');
    }
}
