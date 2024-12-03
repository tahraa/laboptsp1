<?php

namespace App\Http\Controllers;

use App\Imports\CouplebImport;
use App\Imports\CoupleImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CouplebImportController extends Controller
{
    public function importFrom(){
        return view('couplesB.form-import');
    }

    public function import(Request $request){
        Excel::import(new CouplebImport, $request->file);
        return redirect('/couplesB');
    }
}
