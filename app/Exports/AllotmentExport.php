<?php

namespace App\Exports;

use App\boyshostel;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class AllotmentExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function forYear(int $year)
    {
        $this->year = $year;
        
        return $this;
    }

    public function query()
    {
        return boyshostel::query()->select('regno','name','year','branch','hostel_id','floor','roomno')->whereNotNull('regno')->where('year',$this->year);
    }
    public function headings(): array
    {
        return [
            'Registration',
            'Name',
            'year',
            'branch',
            'hostel',
            'floor',
            'roomno'
        ];
    }
}
