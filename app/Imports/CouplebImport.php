<?php

namespace App\Imports;

use App\Beneficier;
use App\Couple;
use App\CoupleB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CouplebImport implements ToModel, WithHeadingRow
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
        $ben = Beneficier::where('matricule', '=',$row['matricule'])->firstOrFail();
        return new CoupleB([
            "nni" => $row['nni'],
            "nom" => $row['nom'],
            "prenom" => $row['prenom'],
            "statut" => 1,
            "sexe" => $sexe,
            "type" => 'Conjoint Bénéficier',
            "num_cnam" => $row['num_cnam'],
            "situation_civile" => $row['situation_civile'],
            "matricule" => $row['matricule'],
            "service" => $row['service'],
            "beneficier_id" => $ben->id,
            "date_naissance" => Date::excelToDateTimeObject($row['date_naissance']),
            "date_mariage" => Date::excelToDateTimeObject($row['date_mariage']),
        ]);
    }
}
