<?php

namespace App\Exports;

use App\Affaire;
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
class EmployesExport implements
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
        return Affaire::query();
    }

    public function headings(): array
    {
 return [
 
                'رقم القضية',
               'نوع القضية',
			                  'تاريخ القضية',
           	 'الجهة المبلغة',
                'المرجع',
             'رقم التنويه',
               'مكان التدخل',
			      'تاريخ ومدة التدخل',
              'مكان اخذ العينات ',
			   'تاريخ اخذ العينات',
			  ' رقم التقرير ',
			  ' رقم الارسالية'
			

        ];
    }





    public function map($emp): array
    {
    return [
        $emp->num_affaire,
        $emp->type,
		       $emp->date,
        $emp->partie_declarent,
		    $emp->reference,
        $emp->num_affaire_c,
        $emp->lieu_crime,
		    $emp->periode,
       $emp->lieu_prelevement, 
	   $emp->date_prelevement,
	    $emp->num_rapport,
		 $emp->num_soit,

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
                            'color' => ['argb' => '#454B1B'],
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




















