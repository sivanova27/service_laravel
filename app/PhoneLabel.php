<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneLabel extends Model {

	//
	
	public function phone()
	{
		return $this->hasMany('App\Phone');
	}

}
