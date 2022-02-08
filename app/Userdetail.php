<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
    protected $table = 'user_data';

    protected $fillable = [
        'regno','name','year','branch','email','sex',
    ];

    public function yearname(){

		return $this->belongsTo('App\year','year','year');
	}

	public function branchname(){

		return $this->belongsTo('App\branch','branch','branch');
	}
}
