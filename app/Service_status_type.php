<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_status_type extends Model {

	protected $fillable = [];
	public $timestamps = FALSE;
	
	public function services(){
		return $this->hasMany('App\Service');
	}
	
	public function cases(){
		return $this->hasMany('App\Case');
	}
}
