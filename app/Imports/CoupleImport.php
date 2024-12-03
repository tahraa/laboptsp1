<?php

namespace App\Imports;

use App\Commiseriat;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Support\Carbon;


class CoupleImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{

    use Importable, SkipsFailures;

    public function rules(): array
    {
        return [
        ];
    }



    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

   return new Commiseriat([


            'nom' => $row['nom'],
            'region' => $row['region'],
            'contact' => $row['contact'],



        ]);
    }
}






