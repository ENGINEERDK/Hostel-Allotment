<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class application extends Model
{
	protected $primaryKey = 'regno';

	public function studentyear(){

		return $this->belongsTo('App\year','year','year');
	}

	public function studentbranch(){

		return $this->belongsTo('App\branch','branch','branch');
	}

	public function accomodation(){

		return $this->belongsTo('App\year','accm_for','year');
	}

	public function hostelpref1(){

		return $this->belongsTo('App\hostels','hostel_pref1','hostel_id');
	}

	public function hostelpref2(){

		return $this->belongsTo('App\hostels','hostel_pref2','hostel_id');
	}

	public function hostelpref3(){

		return $this->belongsTo('App\hostels','hostel_pref3','hostel_id');
	}

	public function hostelpref4(){

		return $this->belongsTo('App\hostels','hostel_pref4','hostel_id');
	}

	public function floorpref1(){

		return $this->belongsTo('App\floor','floor_pref1','floor');
	}
	public function floorpref2(){

		return $this->belongsTo('App\floor','floor_pref2','floor');
	}
	public function floorpref3(){

		return $this->belongsTo('App\floor','floor_pref3','floor');
	}
	public function floorpref4(){

		return $this->belongsTo('App\floor','floor_pref4','floor');
	}

	public function roompref1(){

		return $this->belongsTo('App\roomtype','room_pref1','roomtype');
	}
	public function roompref2(){

		return $this->belongsTo('App\roomtype','room_pref2','roomtype');
	}
	public function roompref3(){

		return $this->belongsTo('App\roomtype','room_pref3','roomtype');
	}
	public function roompref4(){

		return $this->belongsTo('App\roomtype','room_pref4','roomtype');
	}
}
