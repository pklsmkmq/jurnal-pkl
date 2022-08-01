<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;

class userImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new User([
            "name"=>$row[1],
            "email"=>$row[2],
            "password"=>bcrypt("pklsmkmq2022"),
            "status"=>"santri"
        ]);
    }
}
