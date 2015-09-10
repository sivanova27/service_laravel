<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model {

	//
	
	protected $fillable = ['employee_id','label_id','number'];
	
	public function employee()
	{
		return $this->belongsTo('App\Employee');
	}
	
	public function label()
	{
		return $this->belongsTo('App\PhoneLabel');
	}

}
