<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	//
	protected $fillable = ['parent_company_id','name','setup'];
	
	
	public function scopeUserCompanies($query, $user = null){
		if (!$user) {
			$user = \Auth::user();
		}
		if($user){
			return $query->where('id',$user->company_id)->orWhere('parent_company_id',$user->company_id);
		}
		else {
			return $query->where('id',2)->orWhere('parent_company_id',2);
		}
		
	}
	
	public function users()
    {
        return $this->hasMany('App\User');
    }
	
	public function employees()
	{
		return $this->hasMany('App\Employee');
	}
	
	public function residences()
	{
		return $this->hasMany('App\Residence');
	}
	
	public function brands()
	{
		return $this->hasMany('App\Brand');
	}
	
	public function qualities()
	{
		return $this->hasMany('App\Qualities');
	}
	
	public function services()
	{
		return $this->hasMany('App\Services');
	}
	
	public function review_types()
	{
		return $this->hasMany('App\Review_type');
	}
	
	public function compensation_types()
	{
		return $this->hasMany('App\Compensation_type');
	}
	
	public function case_statuses()
	{
		return $this->hasMany('App\Case_status');
	}
}
