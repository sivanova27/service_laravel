<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualities extends Model {

	//
	public function company(){
		return $this->belongsTo('App\Company');
	}
	
	public function employee(){
		return $this->belongsToMany('App\Employee','employees');
	}
	
	public function scopeCompanyQualities($query,$user = null){
		if(!$user){
			$user = \Auth::user();
		}
		if($user){
			return $query->where('company_id',$user->company_id);
		}
		else {
			return $query->where('company_id',2);
		}
	}

}
