<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

	//
	protected $fillable = ['company_id','name'];
	
	public function company()
	{
		$this->belongsTo('App\Company');
	}
	
	public function employee()
	{
		$this->belongsToMany('App\Employee');
	}
	
	public function scopeCompanyBrands($query,$user = null){
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
