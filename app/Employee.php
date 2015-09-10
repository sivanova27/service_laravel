<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	//
	protected $fillable = ['XRM_id','company_id','residences_id','nickname','name','email','skype','photo','uniform_size','birth_date','address','working_days','rate','agreement','signed_agreement',
							'debt','grade','for_royalty_date','start_date','end_date','late_work','start_from','early_finish','bank_account','nin','li','smoker','positive_feedbacks','negative_feedbacks',
							'complaints','cancellations','small_damages','big_damages','compensation_sum','total_checks','experience','average_grade','rating','stars','hide_in_royalty','status'];

	public function company(){
		return $this->belongsTo('App\Company');
	}
	
	public function cases(){
		return $this->hasMany('App\Cases');
	}
	
	public function phone(){
		return $this->hasMany('App\Phone','id');
	}
	
	public function language()
    {
        return $this->belongsToMany('App\Language')->withPivot('level');
    }
	
	public function brand()
    {
        return $this->belongsToMany('App\Brand');
    }
	
	public function qualities()
	{
		return $this->belongsToMany('App\Qualities','employee_quality')->withPivot('value');
	}
	
	public function residence()
	{
		return $this->belongsTo('App\Residence','residences_id');
	}

	public function dates(){
		return $this->hasMany('App\Dates','employees_id');
	}
	
	public function notes(){
		return $this->hasMany('App\Note','section_id');
	}
	
	public function scopeStatus($query,$status)
	{
		return $query->where('status','like',$status);
	}

	
	
	
}
