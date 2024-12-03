<?php

namespace App\Imports;

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
      
        $sexe = '';
        if($row['sexe'] == 'Masculin'){
            $sexe = 'masculin';
        }else{
            $sexe = 'feminin';
        }

        return new Employe([

            'nni'=> $row['nni'],
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'matricule' => $row['matricule'],
            'num_cnam' => $row['num_cnam'],
            'statut' => 1,
            'sexe' => $sexe,
            'date_naissance' => Carbon::parse($row['date_naissance']),
            'service' => $row['service'],
            'situation_civile' => $row['situation_civile'],
            'type' => 'Agent SNIM'


        ]);
    }
}






