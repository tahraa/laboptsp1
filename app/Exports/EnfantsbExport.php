<?php

namespace App\Exports;

use App\EnfantB;
use Maatwebsite\Excel\Concerns\FromCollection;
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
use Maatwebsite\Excel\Events\BeforeExport;

class EnfantsbExport implements 
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
        return EnfantB::query();
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
                'statut',
                'scolarite',
                'Handicapé',
                'Etablissement',
           
        ];
    }
 public function map($enf): array
    {
    return [
        $enf->nni,
        $enf->nom,
        $enf->prenom, 
        $enf->matricule,
        $enf->num_cnam,
        $enf->sexe, 
        $enf->date_naissance, 
        $enf->statut,
        $enf->scolarite,
        $enf->handicap,  
        $enf->etablissement,  
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
                            'color' => ['argb' => '#0520FB'],
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














