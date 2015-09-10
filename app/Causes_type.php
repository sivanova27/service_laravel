<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Causes_type extends Model {

	protected $fillable = ['company_id','name'];

	public function company(){
		return $this->belongsTo('App\Company');
	}
	
	public function complaint_causes(){
		return $this->hasMany('App\Complaint_causes');
	}
}
