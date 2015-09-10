<?php namespace App\Http\Controllers;

use App\User;
use App\Residence;
use App\Language;
use App\Brand;
use App\Employee;
use App\Phone;
use App\Company;
use App\Qualities;
use Input;

class SearchController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//helpers
		$rating_date=mktime(0, 0, 0,  date('n', time()), date('j', time()), date('Y', time()));
		//get form select options and quality radio buttons
		$brands = Brand::companyBrands()->get()->lists('name','id');
		$residences = Residence::companyResidences()->get()->lists('name','id');
		$companies = Company::userCompanies()->get()->lists('name','id');
		$companies_ids = Company::userCompanies()->get()->lists('id');
		foreach($companies_ids as $company_id){
			$company_ids[] = $company_id;
		}
		$languages = Language::all()->lists('name','id');
		array_unshift($languages, "Choose other language");
		$qualities = Qualities::CompanyQualities()->get();
		
		//get all employees
		$employees = Employee::whereIn('company_id',$company_ids)
							 ->with('company','residence','phone','qualities','language')
							 ->with(['dates' => function($query){
							 	$query->whereRaw('(? BETWEEN dates.start AND dates.end OR dates.start>?) AND dates.type IN("day_off", "annual_leave")', array(mktime(0, 0, 0,  date('n', time()), date('j', time()), date('Y', time())), mktime(0, 0, 0,  date('n', time()), date('j', time()), date('Y', time()))));
							 }])
							 ->status('active')
							 ->get();
		
		//return $employees;
		return view('search',compact('brands','residences','languages','employees','rating_date','qualities','companies'));
	}
	
	public function search()
	{
		//helpers
		$rating_date=mktime(0, 0, 0,  date('n', time()), date('j', time()), date('Y', time()));
		
		//get form select options and quality radio buttons
		$brands = Brand::companyBrands()->get()->lists('name','id');
		$residences = Residence::companyResidences()->get()->lists('name','id');
		$companies = Company::userCompanies()->get()->lists('name','id');
		$companies_ids = Company::userCompanies()->get()->lists('id');
		foreach($companies_ids as $company_id){
			$company_ids[] = $company_id;
		}
		$languages = Language::all()->lists('name','id');
		array_unshift($languages, "Choose other language");
		$qualities = Qualities::CompanyQualities()->get();
		
		$inputs = Input::all();
		$employees = Employee::query();
		
		$employees->whereIn('company_id',$company_ids)
				  ->with('company','residence','phone','qualities','language')
				  ->with(['dates' => function($query){
							 	$query->whereRaw('(? BETWEEN dates.start AND dates.end OR dates.start>?) AND dates.type IN("day_off", "annual_leave")', array(mktime(0, 0, 0,  date('n', time()), date('j', time()), date('Y', time())), mktime(0, 0, 0,  date('n', time()), date('j', time()), date('Y', time()))));
					    }]);
		//dd($inputs);
		if (Input::has('company_id') && is_array($inputs['company_id'])){
		     $employees->whereIn('company_id',$inputs['company_id']);
		}
		if (Input::has('nickname')){
		     $employees->where('nickname','like','%'.$inputs['nickname'].'%');
		  }
		if (Input::has('name')){
		     $employees->where('name','like','%'.$inputs['name'].'%');
		  }
		if (Input::has('brand_id') && is_array($inputs['brand_id'])){
			 $employees->join('brand_employee', 'employees.id', '=', 'brand_employee.employee_id')->whereIn('brand_employee.brand_id',$inputs['brand_id']);
		  }
		if (Input::has('residences_id') && is_array($inputs['residences_id'])){
		     $employees->whereIn('residences_id',$inputs['residences_id']);
		  }
		if (Input::has('address')){
		     $employees->where('address','like','%'.$inputs['address'].'%');
		  }
		if(Input::has('phone')){
		  		$employees->join('phones', 'employees.id', '=', 'phones.employee_id')->where('phones.number','like','%'.$inputs['phone'].'%');
		  }
		if (Input::has('email')){
		     $employees->where('email','like','%'.$inputs['email'].'%');
		  }
		if (Input::has('agreement')) {
		     $employees->where('agreement','like','%'.$inputs['agreement'].'%');
		  }
		if (Input::has('no_agreement') && $inputs['agreement']==''){
		  	$employees->where('agreement','=','');
		  }
		if(Input::has('signed_agreement')){
		  	$employees->where('signed_agreement','=',$inputs['signed_agreement']);
		  }
		if(Input::has('working_days')){
			$all_work = array_fill(0,7,0);
			foreach($inputs['working_days'] as $work_day){
				$all_work[$work_day] = 1;
			}
			$employees->where('working_days','like',implode('',$all_work));
		}
		if(Input::has('start_from')){
		  	$employees->where('start_from','<=',$inputs['start_from']);
		  }
		if(Input::has('early_finish')){
		  	$employees->where('early_finish','>=',$inputs['early_finish']);
		  } 
		if(Input::has('birth_date') && $inputs['birth_date']['from']!=''){
			$birth_date_start=strtotime($inputs['birth_date']['from']);
			$birth_date_end=strtotime($inputs['birth_date']['to']);
			if ($inputs['birth_date']['to']=='') {
				$birth_date_end=strtotime($inputs['birth_date']['from'])+60*60*24;
			}
			$employees->whereBetween('birth_date',[$birth_date_start, $birth_date_end]);
		}
		if (Input::has('start_date') && $inputs['start_date']['start']!='') {
			$start_date_start=strtotime($inputs['start_date']['start']);
			$start_date_end=strtotime($inputs['start_date']['end']);
			if ($inputs['start_date']['end']=='') {
				$start_date_end=$rating_date;
			}
			$employees->whereBetween('start_date', [$start_date_start, $start_date_end]);
		}
		if(Input::has('annual_leave') && $inputs['annual_leave']['start']!=''){
			$leave_start=strtotime($inputs['annual_leave']['start']);
			$leave_end=strtotime($inputs['annual_leave']['end']);
			if ($inputs['annual_leave']['end']=='') {
				$leave_end=$leave_start+60*60*24;
			}
			$employees->join('dates', 'employees.id', '=', 'dates.employees_id')
			->where('dates.type','like','annual_leave')
			->whereBetween('dates.start', [$leave_start,$leave_end])
			->orWhere(function($query) use ($leave_start,$leave_end)
            {
                $query->whereBetween('dates.end', [$leave_start,$leave_end]);
            });
		}
		
		if(Input::has('day_off') && $inputs['day_off']['start']!=''){
			$dayoff_start=strtotime($inputs['day_off']['start']);
			$dayoff_end=strtotime($inputs['day_off']['end']);
			if ($inputs['day_off']['end']=='') {
				$dayoff_end=$dayoff_start+60*60*24;
			}
			$employees->join('dates', 'employees.id', '=', 'dates.employees_id')
			->where('dates.type','like','day_off')
			->whereBetween('dates.start', [$dayoff_start,$dayoff_end])
			->orWhere(function($query) use ($dayoff_start,$dayoff_end)
            {
                $query->whereBetween('dates.end', [$dayoff_start,$dayoff_end]);
            });
		}
		if(Input::has('quit_date') && $inputs['quit_date']['start']!=''){
			$quit_start=strtotime($inputs['quit_date']['start']);
			$quit_end=strtotime($inputs['quit_date']['end']);
			if ($inputs['quit_date']['end']=='') {
				$quit_end=$quit_start+60*60*24;
			}
			$employees->join('dates', 'employees.id', '=', 'dates.employees_id')
			->whereBetween('dates.end', [$quit_start,$quit_end]);
		}
		
		if(Input::has('en_language')){
			$levels = array('excellent','very_good','good','average','bad','basic');
			foreach($inputs['en_language'] as $level){
				$search_levels[] = $levels[$level];
			}
			$employees->join('employee_language','employees.id','=','employee_language.employee_id')->where('language_id','=','en')->whereIn('level',$search_levels);
			
		}
		
		if(Input::has('languages') && sizeof($inputs['languages'])>1){
			
			$employees->join('employee_language','employees.id','=','employee_language.employee_id')->whereIn('language_id',$inputs['languages']);
		}
		if(Input::has('uniform_size') && $inputs['uniform_size']!=''){
			$employees->where('uniform_size','like',$inputs['uniform_size']);
		}
		if(Input::has('rate') && $inputs['rate']!=''){
			$employees->where('rate','like',$inputs['rate']);
		}
		if(Input::has('quality')){
			$employees->join('employee_quality','employees.id','=','employee_quality.employee_id');
			foreach($inputs['quality'] as $quality_id=>$quality_value) {
				if ($quality_value==0) {
					$employees->whereRaw('employees.id NOT IN(SELECT employee_id FROM employee_quality WHERE qualities_id=?)', [$quality_id]);
				} else {
					$employees->where('employee_quality.qualities_id','=', $quality_id);
				}
			}
		}
		if(Input::has('smoker')){
			$employees->where('smoker','=',$inputs['smoker']);
		}
		if(Input::has('debt')){
			$employees->where('debt','=',$inputs['debt']);
		}
		
		if(Input::has('grade')){
			foreach($inputs['grade'] as $grade_level){
				$employees->orWhere('average_grade','>=',$grade_level)->where('average_grade','<',$grade_level+1);
			}
		}
		if(Input::has('rating')){
			foreach($inputs['rating'] as $rating){
				$rating_array[] = $rating;
			}
			$employees->whereIn('rating',$rating_array);
		}
		if(Input::has('status')){
			$count = 0;
			foreach($inputs['status'] as $name=>$status){
					if($count==0){
						$employees->where('status',$name);
					}
					else{
						$employees->orWhere('status',$name);
					}
					$count++;
			}
		}		
		
		// var_dump($employees->get()->toArray());
		
		$employees = $employees->get();
		
		return view('search', compact('brands', 'residences', 'languages', 'employees', 'rating_date', 'qualities','companies'));
	}
}
