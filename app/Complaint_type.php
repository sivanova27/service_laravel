<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint_type extends Model {

	protected $fillable = ['company_id','name'];
	public $timestamps = FALSE;
	
	public function company(){
		return $this->belongsTo('App\Company');
	}
	
	public function cases(){
		return $this->hasMany('App\Cases');
	}

}
