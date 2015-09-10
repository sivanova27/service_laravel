<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Response_type extends Model {

	protected $fillable = ['company_id','name','pos'];
	public $timestamps = FALSE;

	public function company(){
		return $this->belongsTo('App\Company');
	}
}
