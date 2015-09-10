<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

	//
	protected $fillable = ['section_id','section_type','note','type','note_time'];
	
	public function user(){
		return $this->belongsTo('App\User');
	} 

	public function employee(){
		return $this->belongsTo('App\Employee');
	}
	
}
