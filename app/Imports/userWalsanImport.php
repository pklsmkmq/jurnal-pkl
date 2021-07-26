<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;

class userWalsanImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new User([
            "name"=>$row[1],
            "email"=>$row[2],
            "password"=>bcrypt("walsansmkmq2021"),
            "status"=>"walsan"
        ]);
    }
}