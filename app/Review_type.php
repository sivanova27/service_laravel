<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Review_type extends Model {

	//
	public $timestamps = false;
	
	protected $fillable = ['company_id','name','pos']; 
	
	public function company(){
		return $this->belongsTo('App\Company');
	}
	
	public function services(){
		return $this->hasMany('App\Service');
	}
	
	public function cases(){
		return $this->hasMany('App\Case','review_types_id');
	}

}
