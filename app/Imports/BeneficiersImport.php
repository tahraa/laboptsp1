<?php

namespace App\Imports;

use App\Beneficier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class BeneficiersImport implements ToModel, WithHeadingRow
{
   
    public function model(array $row)
    {
        $sexe = '';
        if($row['sexe'] == 'Masculin'){
            $sexe = 'masculin';
        }else{
            $sexe = 'feminin';
        }

        return new Beneficier([
            'nni'=> $row['nni'],
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'matricule' => $row['matricule'],
            'num_cnam' => $row['num_cnam'],
            'statut' => 1,
            'sexe' => $sexe,
            'date_naissance' => Carbon::parse($row['date_naissance']),
            'date_recrutement' => Carbon::parse($row['recrutement']),
            'service' => $row['service'],
            'situation_civile' => $row['situation_civile'],
            'type' => 'Bénéficier',
        ]);
    }
}
