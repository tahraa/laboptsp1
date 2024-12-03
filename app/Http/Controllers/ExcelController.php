<?php

namespace App\Http\Controllers;
use App\Exports\Usersexport;
use App\Exports\BeneficiersExport;
use App\Exports\EmployesExport;
use App\Exports\EnfantsExport;
use App\Exports\EnfantsbExport;
use App\Exports\CouplesExport;
use App\Exports\CouplesbExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller 
{
   
    public function users() 
    {
        return Excel::download(new Usersexport, 'users.xlsx');

    }
    public function beneficiers() 
    {
        return Excel::download(new BeneficiersExport, 'Tiers.xlsx');

    }

    public function employes() 
    {
        return Excel::download(new EmployesExport, 'employes.xlsx');

    }
    
    public function enfants() 
    {
        return Excel::download(new EnfantsExport, 'enfants.xlsx');

    }
    public function enfantsb() 
    {
        return Excel::download(new EnfantsbExport, 'enfantsTiers.xlsx');

    }

    public function conjoints() 
    {
        return Excel::download(new CouplesExport, 'conjoints.xlsx');

    }

    public function conjointsb() 
    {
        return Excel::download(new CouplesbExport, 'conjointsTiers.xlsx');

    }

}
