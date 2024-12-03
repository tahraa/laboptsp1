<?php

namespace App\Exports;

use App\Couple;

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
class CouplesExport implements 
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
        return Couple::query();
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
                'statut',
                'situation_de_famille',
                'Etablissement',
           
        ];
    }





    public function map($c): array
    {
    return [
        $c->nni,
        $c->nom,
        $c->prenom, 
        $c->matricule,
        $c->num_cnam,
        $c->sexe, 
        $c->date_naissance, 
        $c->date_mariage,
        $c->statut,
        $c->situation_de_famille, 
        $c->etablissement,  
    ];
          
    }




    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A4:L4')->applyFromArray([
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
        return 'A4';
    }

}













