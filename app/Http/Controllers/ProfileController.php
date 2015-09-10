<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Residence;
use App\Language;
use App\Brand;
use App\Employee;
use App\Phone;
use App\Qualities;
use App\Employee_case;
use App\Cases;
use Input;
use DB;
use App\Review_type;

class ProfileController extends Controller {

	//
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	
	public function index($id){
		$user = \Auth::user(); 
		//get all qualities
		$qualities = Qualities::all();
		//get all review types
		$reviews = Review_type::all();
		$employee_data = Employee::where('id','=',$id)
							 ->with('company','residence','phone','qualities','language')
							 ->with(['notes' => function($query){
							 	$query->where('section_type','=','employee')->with('user');
							 }])
							 ->with(['dates' => function($query){
							 	$query->whereRaw('(? BETWEEN dates.start AND dates.end OR dates.start>?) AND dates.type IN("day_off", "annual_leave")', array(mktime(0, 0, 0,  date('n', time()), date('j', time()), date('Y', time())), mktime(0, 0, 0,  date('n', time()), date('j', time()), date('Y', time()))));
							 }])
							 ->first();
		//dd($employee_data);	
		$employee_rating = DB::select('select FORMAT(AVG(stars), 4) AS average, FROM_UNIXTIME(`date`, \'%M %Y\') AS month_date, FROM_UNIXTIME(`date`, \'%Y %m\') AS month_order from employee_rating where employees_id = ? GROUP BY month_order', [$id]);
		//dd($employee_rating);
		foreach($employee_rating as $rating){
			$labels[] = $rating->month_date;
			$data[] = $rating->average;
		}
		$labels = json_encode($labels);
		$data = json_encode($data);
		return view('profile',compact('employee_data','user','qualities','labels','data','reviews'));
	}

	public function getcomplaints(Request $request){
		$employee_id = $request['employee_id'];
		$start_date = strtotime($request['from']);
		$end_date = strtotime($request['to']);
		
		//get all employee cases
		
		$cases = Cases::with('employee','service','review_types','complaint_type','complaint_cause','case_status')->where('employee_id',$employee_id);
		
		if($start_date){
			$cases->where('created','>=',$start_date);
		}
		if($end_date){
			$cases->where('created','<=',$end_date);
		}
		if($request['reviews']){
			$cases->whereIn('review_types_id',$request['reviews']);
		}
		$cases = $cases->get();
		dd($cases);
		return view('ajax.complaint_history', compact('cases'));
	}

}
