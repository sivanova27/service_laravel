@extends('app')

@section('content')
<h1>Search Professionals</h1>
	{!! Form::open(array('url'=>'/search','method'=>'POST','id'=>'search_form')) !!}

<div class="row">
	<fieldset>
	<legend>Search by some personal info</legend>
	<div class="content">
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label('company_id','Contractor',['class'=>'l-large']) !!}
			{!! Form::select('company_id[]',$companies, Input::get('company_id'),['multiple'=>'multiple','class'=>'selectpicker']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('nickname','Professional\'s nickname',['class'=>'l-large']) !!}
			{!! Form::input('text','nickname',Input::get('nickname'),['class'=>'input-xlarge']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('name','Professional\'s full name',['class'=>'l-large']) !!}
			{!! Form::input('text','name',Input::get('name'),['class'=>'input-xlarge']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('brand_id','Company',['class'=>'l-large']) !!}
			{!! Form::select('brand_id[]',$brands, Input::get('brand_id'),['multiple'=>'multiple','class'=>'selectpicker']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('residences_id','Residence',['class'=>'l-large']) !!}
			{!! Form::select('residences_id[]',$residences,Input::get('residences_id'),['multiple'=>'multiple','class'=>'selectpicker']) !!}
		</div>
	</div>
	<div class="col-md-4">	
		<div class="form-group">
			{!! Form::label('address','UK address/postcode',['class'=>'l-large']) !!}
			{!! Form::input('text','address',Input::get('address'),['class'=>'input-xlarge']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('phone','Phone',['class'=>'l-large']) !!}
			{!! Form::input('text','phone',Input::get('phone'),['class'=>'input-xlarge']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('email','Email',['class'=>'l-large']) !!}
			{!! Form::input('text','email',Input::get('email'),['class'=>'input-xlarge']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('agreement','Agreement',['class'=>'l-large']) !!}
			{!! Form::input('text','agreement',Input::get('agreement'),['class'=>'input-xlarge']) !!}
		</div>
		<div class="form-group">
			{!! Form::checkbox('no_agreement', $value = 1, Input::get('no_agreement'),['class'=>'l-small']) !!}
			{!! Form::label('no_agreement','No agreement') !!}
		</div>
		<div class="form-group">
			{!! Form::label('signed_agreement','Signed agreement') !!}
			{!! Form::radio('signed_agreement', $value = '1', (Input::get('signed_agreement') == '1')) !!}
			{!! Form::label('yes','Yes') !!}
			{!! Form::radio('signed_agreement', $value = '0',  (Input::get('signed_agreement') == '0')) !!}
			{!! Form::label('no','No') !!}
		</div>
	</div><!-- end of col-->
	</div>
</fieldset>
	<fieldset>
	<legend>Search by working days, dates, etc</legend>
	<div class="col-md-4 content">
		<div class="form-group">
			<div class="btn-group" id="btns">
				<button type="button" id="mon-fri-button" class="btn btn-inverse btn-week-days">Mon to Fri</button>
				<button type="button" id="mon-sat-button" class="btn btn-inverse btn-week-days">Mon to Sat</button>
				<button type="button" id="mon-sun-button" class="btn btn-inverse btn-week-days">Mon to Sun</button>
			</div>
			{!! Form::select('working_days[]',Config::get('constants.week_days'),null,['multiple'=>'multiple','class'=>'selectpicker','id'=>'working_days']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('start_from','Start from',['class'=>'l-small']) !!}
			{!! Form::input('time','start_from',Input::get('start_from'),['class'=>'input-xsmall time','id'=>'start_from']) !!}
			{!! Form::label('early_finish','Finish by',['class'=>'l-small']) !!}
			{!! Form::input('time','early_finish',Input::get('early_finish'),['class'=>'input-xsmall time','id'=>'early_finish']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('birth_from','Date of birth from',['class'=>'l-small']) !!}
			{!! Form::input('text','birth_date[from]',Input::get("birth_date.from"),['class'=>'date-short input-xsmall','id'=>'birth_from','readonly'=>'readonly']) !!}
			{!! Form::label('birth_to','Date of birth to',['class'=>'l-small']) !!}
			{!! Form::input('text','birth_date[to]',Input::get("birth_date.to"),['class'=>'date-short input-xsmall','id'=>'birth_to','readonly'=>'readonly']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('start_from','Start date from',['class'=>'l-small']) !!}
			{!! Form::input('text','start_date[start]',Input::get("start_date.start"),['class'=>'date-short input-xsmall','id'=>'start_from','readonly'=>'readonly']) !!}
			{!! Form::label('start_to','Start date to',['class'=>'l-small']) !!}
			{!! Form::input('text','start_date[end]',Input::get("start_date.end"),['class'=>'date-short input-xsmall','id'=>'start_to','readonly'=>'readonly']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('annual_from','Annual start',['class'=>'l-small']) !!}
			{!! Form::input('text','annual_leave[start]',Input::get("annual_leave.start"),['class'=>'date-short input-xsmall','id'=>'annual_from','readonly'=>'readonly']) !!}
			{!! Form::label('annual_to','Annual return',['class'=>'l-small']) !!}
			{!! Form::input('text','annual_leave[end]',Input::get("annual_leave.end"),['class'=>'date-short input-xsmall','id'=>'annual_to','readonly'=>'readonly']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('dayoff_from','Day off start',['class'=>'l-small']) !!}
			{!! Form::input('text','day_off[start]',Input::get("day_off.start"),['class'=>'date-short input-xsmall','id'=>'dayoff_start','readonly'=>'readonly']) !!}
			{!! Form::label('dayoff_to','Day off return',['class'=>'l-small']) !!}
			{!! Form::input('text','day_off[end]',Input::get("day_off.end"),['class'=>'date-short input-xsmall','id'=>'dayoff_to','readonly'=>'readonly']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('quit_from','Quit date from',['class'=>'l-small']) !!}
			{!! Form::input('text','quit_date[start]',Input::get("quit_date.start"),['class'=>'date-short input-xsmall','id'=>'quit_from','readonly'=>'readonly']) !!}
			{!! Form::label('quit_to','Quit date to',['class'=>'l-small']) !!}
			{!! Form::input('text','quit_date[end]',Input::get("quit_date.end"),['class'=>'date-short input-xsmall','id'=>'quit_to','readonly'=>'readonly']) !!}
		</div>
	</div><!-- end of col -->
	</fieldset>
	<fieldset>
	<legend>Search by languages, qualities, rating and status</legend>
	<div class="content">
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label('en_language','English Language',['class'=>'l-large']) !!}
			{!! Form::select('en_language[]',Config::get('constants.en_level'),Input::get('en_language'),['multiple'=>'multiple','class'=>'selectpicker']) !!}
			<div id="new-lang" class="hide">
			{!! Form::select('languages[]',$languages,Input::get('languages'),['class'=>'languages']) !!}
			<button type="button" class="close inline">×</button>
			</div>
			{!! Form::button('Other languages',['id'=>'btn-new-lang','class'=>'btn btn-link clearfix']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('grade','Supervisor grade',['class'=>'l-large']) !!}
			{!! Form::select('grade[]',Config::get('constants.grade'),Input::get('grade'),['multiple'=>'multiple','class'=>'selectpicker']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('rating','Rating',['class'=>'l-large']) !!}
			{!! Form::select('rating[]',Config::get('constants.rating'),Input::get('rating'),['multiple'=>'multiple','class'=>'selectpicker']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('uniform_size','Uniform size',['class'=>'l-small']) !!}
			{!! Form::input('text','uniform_size',Input::get('uniform_size'),['class'=>'input-xsmall']) !!}
		
			{!! Form::label('rate','Rate',['class'=>'l-small']) !!}
			{!! Form::input('text','rate',Input::get('rate'),['class'=>'input-xsmall']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="col-md-3">
		@foreach($qualities as $key=>$quality)
			<div class="form-group">
				{!! Form::label($quality->values,$quality->name,['class'=>'l-large']) !!}
				{!! Form::radio("quality[$quality->id]", $value = 1, (Input::get("quality.$quality->id") == '1')) !!}
				{!! Form::label('yes','Yes') !!}
				{!! Form::radio("quality[$quality->id]", $value = 0, (Input::get("quality.$quality->id") == '0')) !!}
				{!! Form::label('no','No') !!}
			</div>
			@if(($key+1)%5==0)
			</div>
			<div class="col-md-3">
			@endif
		@endforeach
		<div class="form-group">
			{!! Form::label('smoker','Smoker',['class'=>'l-large']) !!}
			{!! Form::radio('smoker', $value = '1', (Input::get("smoker") == '1')) !!}
			{!! Form::label('yes','Yes') !!}
			{!! Form::radio('smoker', $value = '0', (Input::get("smoker") == '0')) !!}
			{!! Form::label('no','No') !!}
		</div>
		<div class="form-group">
			{!! Form::label('debt','Debt',['class'=>'l-large']) !!}
			{!! Form::radio('debt', $value = '1', (Input::get("debt") == '0')) !!}
			{!! Form::label('yes','Yes') !!}
			{!! Form::radio('debt', $value = '0', (Input::get("debt") == '0')) !!}
			{!! Form::label('no','No') !!}
		</div>
		</div>
		<div class="col-md-3">
		<div class="form-group">
			{!! Form::checkbox('status[active]', $value = 1, Input::get("status.active"),['class'=>'l-small check_active','checked'=>'checked']) !!}
			{!! Form::label('active','Active') !!}
		</div>
		<div class="form-group">
			{!! Form::checkbox('status[fired]', $value = 1, Input::get("status.fired"),['class'=>'l-small']) !!}
			{!! Form::label('fired','Fired') !!}
		</div>
		<div class="form-group">
			{!! Form::checkbox('status[correctly_quit]', $value = 1, Input::get("status.correctly_quit"),['class'=>'l-small']) !!}
			{!! Form::label('corr_quit','Correctly Quit') !!}
		</div>
		<div class="form-group">
			{!! Form::checkbox('status[incorrectly_quit]', $value = 1, Input::get("status.incorrectly_quit"),['class'=>'l-small']) !!}
			{!! Form::label('incorr_quit','Incorrectly Quit') !!}
		</div>
	</div><!-- end of col -->
	</div>
	</fieldset>
	
	<div class="form-group">
			{!! Form::reset('Clear',['class'=>'btn btn-full-reset']) !!}
			{!! Form::submit('Search',['name'=>'search','class'=>'btn btn-primary'])!!}
		</div>
</div><!-- end of row -->
	{!! Form::close() !!}
	@include('employees_list')
</div>
@endsection
