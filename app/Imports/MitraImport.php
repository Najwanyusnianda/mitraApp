<?php

namespace App\Imports;

use App\Mitra;
use Maatwebsite\Excel\Concerns\ToModel;

class MitraImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mitra([
            //
        ]);
    }
}
