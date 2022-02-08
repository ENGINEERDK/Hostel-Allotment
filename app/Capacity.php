<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    public function yearname(){

		return $this->belongsTo('App\year','year','year');
	}
}
