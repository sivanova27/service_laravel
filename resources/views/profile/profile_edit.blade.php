
<div class="row">
<div class="col-md-2">
		<ul class="unstyled">
			<li class="thumbnail">
				@if($employee_data->photo)
				<img src="/mytest/uploads/employee_{!!$employee_data->id!!}/thumb_{!!$employee_data->photo!!}" />
				@else
				<img src='/mytest/public/img/default-profile-pic.jpg'/>
				@endif
			</li>
		</ul>
</div>

<div class="col-md-3">
		<ul class="unstyled">
			<li><b>Nickname:</b> {!!$employee_data->nickname!!}</li>
			<li><b>Full Name:</b> {!!$employee_data->name!!}</li>
			<li><b>Date of Birth:</b> {!! date(Config::get('constants.SHORT_DATE_FORMAT'),$employee_data->birth_date)!!}</li>
			<li><b>Age:</b> {!!$employee_data->age!!} &nbsp; <b>Uniform size:</b> {!!$employee_data->uniform_size!!}</lu>
			<li><b>Phones:</b>
				@if($phones=$employee_data->phone)
					<ul>
		  			@foreach($phones as $phone)
		  				<li>{{ $phone->number }}</li>
		  			@endforeach
		  			</ul>
	  			@endif
			</li>
			<li><b>Email:</b> {!!$employee_data->email!!}</li>
			<li><b>Skype:</b> {!!$employee_data->skype!!}</li>
			<li><b>UK Address:</b> {!!$employee_data->address!!}</li>
		</ul>
</div>

<div class="col-md-3">
		<ul class="unstyled">
			<li>
				<b>Company:</b>{!! $employee_data->company->name!!}
			</li>
			<li><b>Bank account:</b> @if ($employee_data->bank_account) Yes @else No @endif</li>
			<li><b>NIN:</b> @if ($employee_data->nin) Yes @else No @endif</li>
			<li><b>LI:</b> @if ($employee_data->li) Yes <em>({!!date(Config::get('constants.SHORT_DATE_FORMAT'),$employee_data->li)!!})</em> @else No @endif</li>
			
			<li><b>Future annual leaves:</b>
				@if($dates = $employee_data->dates)
					<ul>
					@foreach($dates as $date)
						@if($date->type=='annual_leave')
						<li>{{date(Config::get('constants.SHORT_DATE_FORMAT'),$date->start)}} - {{date(Config::get('constants.SHORT_DATE_FORMAT'),$date->end)}}</li>
						@endif
					@endforeach
					</ul>
				@endif
			</li>
			<li><b>Future day off:</b>  
				@if($dates = $employee_data->dates)
					<ul>
					@foreach($dates as $date)
						@if($date->type=='day_off')
						<li>{{date(Config::get('constants.SHORT_DATE_FORMAT'),$date->start)}} - {{date(Config::get('constants.SHORT_DATE_FORMAT'),$date->end)}}</li>
						@endif
					@endforeach
					</ul>
				@endif	
				
			</li>
			
			<li><b>Finish by:</b> @if ($employee_data->early_finish) {!!$employee_data->early_finish!!} @else No @endif</li>
		</ul>
</div>

<div class="col-md-3">
	<ul class="unstyled">
		<li><b>Current rating:</b> <div class="stars-rating stars-rating-{!!$employee_data->stars*10!!}"></div></li>
			<li><b>Expirience:</b> {!!$employee_data->experience!!}</li>
			<li><b>Supervisor grade:</b> {!!$employee_data->average_grade!!}</li>
			<li><b>Start date:</b> {!! date(Config::get('constants.SHORT_DATE_FORMAT'),$employee_data->start_date)!!}</li>
			<li><b>Debt:</b>@if ($employee_data->debt) Yes @else No @endif</li>
			<li><b>Agreement:</b>{!! $employee_data->agreement !!}</li>
			<li><b>Signed agreement:</b>@if ($employee_data->signed_agreement) Yes @else No @endif</li>
			<li><b>Status:</b> {!! $employee_data->status !!}</li>
			<li><b>Quit date:</b> @if ($employee_data->end_date) {!! date(Config::get('constants.SHORT_DATE_FORMAT'),$employee_data->end_date)!!} @endif</li>
	</ul>
</div>
</div>
