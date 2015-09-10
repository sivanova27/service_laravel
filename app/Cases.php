<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model {

	public $timestamps = FALSE;
	
	public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function employee(){
		return $this->belongsTo('App\Employee');
	}
	
	public function service(){
		return $this->belongsTo('App\Service','services_id');
	}
	
	public function service_status_type(){
		return $this->belongsTo('App\Service_status_type');
	}
	
	public function review_types(){
		return $this->belongsTo('App\Review_type');
	}
	
	public function compensation_types(){
		return $this->belongsTo('App\Compensation_type');
	}
	
	public function case_status(){
		return $this->belongsTo('App\Case_status');
	}
	
	public function complaint_type(){
		return $this->belongsToMany('App\Complaint_type');
	}
	
	public function complaint_cause(){
		return $this->belongsToMany('App\Complaint_cause','case_complaint_causes');
	}
	

}
