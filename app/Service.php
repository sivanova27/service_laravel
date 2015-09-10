<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {

	public $timestamps = FALSE;
	protected $fillable = ['company_id','name','pos'];

	public function company(){
		return $this->belongsTo('App\Company');
	}
	
	public function cases(){
		return $this->hasMany('App\Case');
	}
	
}
