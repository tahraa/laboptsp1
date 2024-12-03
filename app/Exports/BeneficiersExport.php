<?php

namespace App\Exports;

use App\Beneficier;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class BeneficiersExport implements 
FromQuery,
 WithHeadings,
  ShouldAutoSize,
   WithMapping,
   WithDrawings,
   WithEvents, WithCustomStartCell
   
{ 
     use Exportable;
   

    public function query()
    {
        return Beneficier::query();
    }
    
    public function headings(): array
    {
            return [
                'nni',
                 'nom', 
                 'prenom', 
                 'matricule',
                 'num_cnam',
                'sexe', 
                'date_naissance', 
                'date_mariage',
                'service',
                ' situation_civile', 
                'situation_de_famille',
                'Etablissement',
           
        ];
    }





    public function map($beneficier): array
    {
    return [
        $beneficier->nni,
        $beneficier->nom,
        $beneficier->prenom, 
        $beneficier->matricule,
        $beneficier->num_cnam,
        $beneficier->sexe, 
        $beneficier->date_naissance, 
        $beneficier->date_mariage,
        $beneficier->service,
        $beneficier->situation_civile, 
        $beneficier->situation_de_famille, 
        $beneficier->etablissement,  
    ];
          
    }




    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A5:L5')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ]
                ]);
            }
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('logo');
        $drawing->setDescription('snim logo');
        $drawing->setPath(public_path('/logo/logo.png'));
        $drawing->setHeight(70);
        $drawing->setCoordinates('A1');
        return $drawing;
    }
    
    public function startCell(): string
    {
        return 'A5';
    }

}


















