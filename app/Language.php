<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

	//
	protected $fillable = ['id','name'];
	
	public function user()
    {
        return $this->belongsToMany('App\User');
    }
	
	public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }

}
