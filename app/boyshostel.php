<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class boyshostel extends Model
{
    public function studentyear(){

		return $this->belongsTo('App\year','year','year');
	}

	public function studentbranch(){

		return $this->belongsTo('App\branch','branch','branch');
	}

	public function typeofroom(){

		return $this->belongsTo('App\roomtype','roomtype','roomtype');
	}

	public function reservation(){

		return $this->belongsTo('App\branch','reserved','branch');
	}

	public function floorname(){

		return $this->belongsTo('App\floor','floor','floor');
	}

	public function hostel(){

		return $this->belongsTo('App\hostels','hostel_id','hostel_id');
	}
}
