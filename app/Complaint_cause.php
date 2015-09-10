<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint_cause extends Model {

	protected $fillable = ['causes_types_id','name'];
	public $timestamps = FALSE;
	
	public function cases(){
		return $this->hasMany('App\Cases');
	}
	
	public function causes_type(){
		return $this->belongsTo('App\Causes_type');
	}

}
