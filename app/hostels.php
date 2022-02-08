<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hostels extends Model
{
    public function hostelcategory(){

		return $this->belongsTo('App\hostelcategory','category','category');
	}
	
}
