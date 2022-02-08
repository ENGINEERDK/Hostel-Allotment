<?php

namespace App\Imports;

use App\Userdetail;
use Maatwebsite\Excel\Concerns\ToModel;

class UserdetailImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if( is_null($row[1]) ||is_null($row[2]) || is_null($row[3]) ||is_null($row[4]) ||is_null($row[5]) ||is_null($row[6])){
                return null;
            }

            elseif (Userdetail::where('regno',$row[1])->first() ) {
                return null;
            }

            else{
                return new Userdetail([
                    'regno'     => $row[1],
                    'name'    => $row[2],
                    'year'    => $row[3], 
                    'branch'    => $row[4],
                    'email'    => $row[5], 
                    'sex'    => $row[6], 
                ]);
            }
    }
}
