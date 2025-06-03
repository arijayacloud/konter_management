<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class MutasiExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $mutasi;

    public function __construct($mutasi)
    {
        $this->mutasi = $mutasi;
    }

    public function collection()
    {
        return $this->mutasi;
    }

    public function headings(): array
    {
        return [
            'TANGGAL',
            'JENIS LAYANAN',
            'LOKASI KONTER',
            'NAMA BANK',
            'NOMOR REKENING',
            'ATAS NAMA',
            'JUMLAH TRANSFER',
            'ADMIN TRANSFER',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // baris header
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'], // putih
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0d6efd'], // biru cerah
                ],
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'], // hitam
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}

