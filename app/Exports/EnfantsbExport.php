<?php

namespace App\Exports;

use App\EnfantB;
use App\Reserve;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class EnfantsbExport implements
FromQuery,
 WithHeadings,
  ShouldAutoSize,
   WithMapping,
   WithDrawings,
   WithEvents, WithCustomStartCell

{
     use Exportable;

     protected $fillable = ['', '','',''];
    public function query()
    {
        return Reserve::query();
    }

    public function headings(): array
    {
            return [
                'Caracteristiques',
                'Etat',
                'N°affaire',
                 'Periode de conservation',

        ];
    }
 public function map($enf): array
    {
    return [
        $enf->num_affaire,
        $enf->etat,
        $enf->caracteristiques,
        $enf->periode_conservation,

    ];

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A3:L3')->applyFromArray([
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
        $drawing->setDescription('laboratoire PTS logo');
        $drawing->setPath(public_path('/logo/logo.png'));
        $drawing->setHeight(40);
        $drawing->setCoordinates('A1');
        return $drawing;
    }

    public function startCell(): string
    {
        return 'A3';
    }

}














