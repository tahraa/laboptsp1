<?php

namespace App\Imports;

use App\Affaire;
use App\Employe;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class EmployeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {


        return new Affaire([
            'num_affaire' => $row['num_affaire'],
            'type'=> $row['type'],
            'partie_declarent' => $row['partie_declarent'],
            'num_affaire_c' => $row['num_affaire_c'],
            'date' => Carbon::parse($row['date']),
            'lieu_crime' => $row['lieu_crime'],
            'num_soit' => $row['num_soit'],



        ]);
    }
}






