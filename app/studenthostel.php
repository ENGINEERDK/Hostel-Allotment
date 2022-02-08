<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\hostels;

class studenthostel extends Model
{
	public function hostelname1(){

		return $this->belongsTo('App\hostels','hostel1','hostel_id');
	}

	public function hostelname2(){

		return $this->belongsTo('App\hostels','hostel2','hostel_id');
	}

	public function hostelname3(){

		return $this->belongsTo('App\hostels','hostel3','hostel_id');
	}

    
}
