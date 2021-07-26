<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\walsan;

class walsanImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new walsan([
            "santri_nisn"=>$row[0],
            "nama_walsan"=>$row[1],
            "email_walsan"=>$row[2],
            "telepon_walsan"=>$row[3]
        ]);
    }
}
