<?php

namespace App\Exports;

use App\Models\exportData;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDTLatih implements FromArray,WithProperties,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data,$heading;

    public function __construct(array $data, array $heading )
    {
        $this->data = $data;
        $this->heading = $heading;
    }
    // public function collection()
    // {
    //     return exportData::all();
    // }
    public function headings(): array
    {
        return $this->heading;
    }
    public function array(): array
    {
        return $this->data;
    }
    public function properties(): array
    {
        return [
            'creator' => 'Deo Artanta',
            'lastModifiedBy' => 'Deo Artanta',
            'title' => 'Test Data Export',
            'description' => 'Test Data Prediction',
            'subject' => 'Test Data',
            'keywords' => 'prediction,export,spreadsheet',
            'category' => 'prediction',
            // 'manager' => 'Deo Artanta',
            // 'company' => 'Maatwebsite',
        ];
    }
}
