<?php

namespace App\Imports;

use App\Beneficier;
use App\Enfant;
use App\EnfantB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class EnfantbImport implements ToModel, WithHeadingRow
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
        $b = Beneficier::where('matricule', '=', $row['matricule'])->firstOrFail();
        return new EnfantB([
            "nni" => $row['nni'],
            "nom" => $row['nom'],
            "prenom" => $row['prenom'],
            "matricule" => $row['matricule'],
            "statut" => 0,
            "sexe" => $sexe,
            "type" => 'Enfant Bénéficier',
            "num_cnam" => $row['num_cnam'],
            "beneficier_id" => 2,
            'date_naissance' => Carbon::parse($row['date_naissance']),
            "service" => $row['service'],
            "handicap" => $row['handicap'],
            "scolarite" => $row['scolarite'],
        ]);
    }
}
