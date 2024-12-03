<?php

namespace App\Imports;

use App\Employe;
use App\Enfant;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class EnfantImport implements ToModel, WithHeadingRow
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
        $emp = Employe::where('matricule', '=',$row['matricule'])->firstOrFail();
        return new Enfant([
            "nni" => $row['nni'],
            "nom" => $row['nom'],
            "prenom" => $row['prenom'],
            "matricule" => $row['matricule'],
            "statut" => 0,
            "sexe" => $sexe,
            "type" => 'Enfant Agent',
            "employe_id" => $emp->id,
            'date_naissance' => Carbon::parse($row['date_naissance']),
            "service" => $row['service'],
            "num_cnam" => $row['num_cnam'],
            "handicap" => $row['handicap'],
            "scolarite" => $row['scolarite'],
        ]);
    }
}
