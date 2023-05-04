<?php

namespace App\Imports;

use App\Media;
use Maatwebsite\Excel\Concerns\ToModel;

class MediaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Media([
            //
            'media_name'=> $row[0],
            'size'=> $row[1],
            'address'=> $row[2],
            'position'=> $row[3],
        ]);
    }
}
