<?php

namespace App\Exports;

use App\User;
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
class UsersExport implements
FromQuery,
 WithHeadings,
  ShouldAutoSize,
   WithMapping, WithDrawings, WithCustomStartCell, WithEvents

{
     use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return User::query();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nom',
            'Email',
            'Profile',
            'created_at',
        ];
    }

    public function map($user): array
    {
  return [
            $user->id,
            $user->name,
            $user->email,
            $user->profile,
           Carbon::parse($user->created_at),
        ];
    }




    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A3:F3')->applyFromArray([
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
        $drawing->setDescription('labo logo');
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

















