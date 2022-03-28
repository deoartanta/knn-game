<?php

namespace App\Imports;

use App\Models\importData;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportDTLatih implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0]>0){
            return new importData([
                'q1'=>$row[0],
                'q2'=>$row[1],
                'q3'=>$row[2],
                'q4'=>$row[3],
                'q5'=>$row[4],
                'q6'=>$row[5],
                'q7'=>$row[6],
                'q8'=>$row[7],
                'q9'=>$row[8],
                'kelas'=>strtolower($row[9])==strtolower("berat")?1:0,
            ]);
        }
    }
}
