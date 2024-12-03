<?php

namespace App\Imports;

use App\Couple;
use App\Employe;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Carbon;


class CoupleImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{

    use Importable, SkipsFailures;

    public function rules(): array
    {
        return [
                // 'email' => 'string|email|max:255|exists:users',
        /* 'date_naissance' => 'required|date_format:YYYY-MM-DD',
        'date_mariage' => 'required|date_format:YYYY-MM-DD',  */
        ];
    }
   


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

       /*  $statut = '0';
        if($row['statut'] == 'OUI'){
            $statut = '1';
        }else{
            $statut = '0';
        } */

        $sexe = '';
        if($row['sexe'] == 'Masculin'){
            $sexe = 'masculin';
        }else{
            $sexe = 'feminin';
        }
        $emp = Employe::where('matricule', '=',$row['matricule'])->firstOrFail();
        return new Couple([
            'nni' => $row['nni'],
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'num_cnam' => $row['num_cnam'],
            'statut' => 1,
            'sexe' => $sexe,
            'type' => 'Conjoint Agent',
            'situation_civile' => $row['situation_civile'],
            'situation_de_famille' => $row['situation_de_famille'],
            'matricule' => $row['matricule'],
            'service' => $row['service'],
            'employe_id' => $emp->id,
            'date_naissance' => Carbon::parse($row['date_naissance']),
            'date_mariage' => Carbon::parse($row['date_mariage'])
        ]);
    }
}
