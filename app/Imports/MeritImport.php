<?php

namespace App\Imports;

use App\Studentmerit;
use Maatwebsite\Excel\Concerns\ToModel;

class MeritImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            if( is_null($row[1]) ||is_null($row[2]) || is_null($row[3]) ||is_null($row[4]) ||is_null($row[5]) ){
                return null;
            }

            elseif (Studentmerit::where('regno',$row[1])->first() ) {
                return null;
            }

            else{
                return new Studentmerit([
                    'regno'     => $row[1],
                    'year'    => $row[2], 
                    'academics'    => $row[3], 
                    'attendance'    => $row[4], 
                    'merit'    => $row[5], 
                ]);
            }
    }
}
