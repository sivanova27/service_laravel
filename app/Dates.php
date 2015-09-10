<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Dates extends Model {

	//
	protected $fillable = ['employees_id','users_id','start','end','comment','emergency','type'];
	
	public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function employee(){
		return $this->belongsTo('App\Employee');
	}

}
