<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model {

	//
	protected $fillable = ['company_id','name','address'];
	
	public function company()
	{
		$this->belongsTo('App\Company');
	}
	
	public function employee()
	{
		$this->hasMany('App\Employee');
	}
	
	public function scopeCompanyResidences($query,$user = null){
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
