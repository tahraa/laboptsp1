<?php

namespace App\Imports;

use App\Beneficier;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
            'date_naissance' => Date::excelToDateTimeObject($row['date_naissance']),
            'service' => $row['service'],
            'situation_civile' => $row['situation_civile'],
            'type' => 'Bénéficier',
        ]);
    }
}
