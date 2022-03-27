<?php

namespace App\Imports;

use App\Models\DTLatih;
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
        return new DTLatih([
            //
        ]);
    }
}
