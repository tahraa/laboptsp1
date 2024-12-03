<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Excel;
use Illuminate\Http\Request;

class BeneficierExportController extends Controller
{

    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function export() 
    {
        return $this->excel->download(new BeneficiersExport, 'beneficiers.xlsx');
    }
}
