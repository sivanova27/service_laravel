<!--start employees table -->
	<div class="table-responsive"> 
	 <table class="table table-hover table-condensed" data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" id="test-table" data-pagination="true" data-page-list="[5, 10, 25, 50, 100]" >
      <thead>
        <tr>
          <th data-sortable="true">Nickname</th>
          <th data-sortable="true">Stars</th>
          <th data-visible="false" data-sortable="true">f(x)</th>
          <th data-visible="false"  data-sortable="true" title="Number of inspections">NI</th>
          <th data-sortable="true">Grade</th>
          <th data-sortable="true">Residence</th>
          <th data-sortable="true">Phone</th>
          <th data-visible="false" data-sortable="true">Days till Quits</th>
          <th class="positive_feedback" title="Positive feedback" data-sortable="true">PF</th>
          <th class="negative_feedback" title="Negative feedback" data-sortable="true">NF</th>
          <th class="complaints" title="Complaints" data-sortable="true">C</th>
          <th class="cancellatins" title="Cancelations" data-sortable="true">☠</th>
          <th class="small-damages" title="Small damages" data-sortable="true">SD</th>
          <th class="big-damages" title="Big damages" data-sortable="true">BD</th>
          <th class="compenstions-given" title="Compensations given" data-sortable="true">&pound;</th>
          <th data-visible="false" data-sortable="true">Age</th>
          <th data-visible="false" data-sortable="true">Uniform Size</th>
          <th data-sortable="true">Smoke</th>
          <th data-visible="false" data-sortable="true">Finish by</th>
          <th data-sortable="true">UK Address</th>
          <th data-sortable="true">Email</th>
          <th data-sortable="true">Name</th>
          <th data-visible="false" data-sortable="true">Start date</th>
          <th data-visible="false" title="Experience" data-sortable="true">Experience</th>
          <th data-visible="false" data-sortable="true">Ironing</th>
          <th data-visible="false" title="References" data-sortable="true">REF</th>
          <th data-sortable="true">English Level</th>
          <th data-sortable="true">Other Languages</th>
          <th data-visible="false" data-sortable="true">LI</th>
          <th data-visible="false" data-sortable="true">LI Exp. Date</th>
          <th data-visible="false" data-sortable="true">LI Days Till Exp.</th>
          <th data-visible="false" data-sortable="true">NIN</th>
          <th data-visible="false" title="Bank Account" data-sortable="true">BA</th>
          <th data-sortable="true">Fear of animals</th>
          <th data-sortable="true">Annual Leave Period</th>
          <th data-visible="false" data-sortable="true">Status</th>
        </tr>
      </thead>
      <tbody>
	@foreach($employees as $employee)
	  <tr class="clickable-row" id="{{$employee->id}}" >
	  	<td>{{ $employee->nickname }}</td>
	  	<td>
	  		@if($employee->stars)
	  			<div class="stars-rating stars-rating-{{$employee->stars*10}}"></div>
	  		@endif
	  	</td>
	  	<td>{{ number_format($employee->rating,2)  }}</td>
	  	<td>{{$employee->total_checks}}</td>
	  	<td>{{ number_format($employee->average_grade,2) }}</td>
	  	<td>
	  		@if($employee->residence)
	  		{{ $employee->residence->name }}
	  		@endif
	  	</td>
	  	<td>
	  		@if($employee->phone)
	  			@foreach($employee->phone as $phone)
	  				{{ $phone->number }}
	  			@endforeach
	  		@endif
	  	</td>
	  	<td>
	  		@if($employee->end_date!=0)
	  			{{ floor(($employee->end_date - $rating_date)/Config::get('constants.A_DAY')) }}
	  		@endif
	  	</td>
	  	<td>{{ $employee->positive_feedbacks }}</td>
	  	<td>{{ $employee->negative_feedbacks }}</td>
	  	<td>{{ $employee->complaints }}</td>
	  	<td>{{ $employee->cancellations }}</td>
	  	<td>{{ $employee->small_damages }}</td>
	  	<td>{{ $employee->big_damages }}</td>
	  	<td>
	  		@if($employee->compensation_sum)
	  		{{ number_format($employee->compensation_sum,2) }}
	  		@endif
	  	</td>
	  	<td>{{ floor((floor((Config::get('constants.NOW') - $employee->birth_date)/Config::get('constants.A_DAY')))/365) }}</td>
	  	<td>{{ $employee->uniform_size }}</td>
	  	<td>
	  		@if($employee->smoker==1)Yes
	  		@elseif($employee->smoker==-1)No
	  		@endif 
	  		</td>
	  	<td>{{ $employee->early_finish }}</td>
	  	<td>{{ $employee->address }}</td>
	  	<td>{{ $employee->email }}</td>
	  	<td>{{ $employee->name }}</td>
	  	<td>{{ date(Config::get('constants.DATE_FORMAT'), $employee->start_date) }}</td>
	  	<td>{{ $employee->experience }}</td>
	  	<td>
	  		@foreach($employee->qualities as $quality)
		  		@if(array_search ('Ironing', $quality->toArray() ))
		  			Yes
		  			@if($quality->pivot->value!='')
		  				- {{$quality->pivot->value}}
		  			@endif
		  		@endif
	  		@endforeach
	  	</td>
	  	<td>
	  		@foreach($employee->qualities as $quality)
	  			@if(array_search ('References', $quality->toArray() ))
		  			Yes
		  			@if($quality->pivot->value!='')
		  				- {{$quality->pivot->value}}
		  			@endif
		  		@endif
	  		@endforeach
	  	</td>
	  	<td>
	  		@foreach($employee->language as $lang)
	  			@if(array_search ('en', $lang->toArray() ))
		  			{{$lang->pivot->level}}
		  		@endif
	  		@endforeach
	  	</td>
	  	<td>@foreach($employee->language as $lang)
	  			@if(!array_search ('en', $lang->toArray() ))
	  				
		  			{{$lang->name}}
					@if($lang->pivot->level!='')
						- {{$lang->pivot->level}}
					@endif
					<br/>
		  		@endif
	  		@endforeach</td>
	  	<td>
	  		@if($employee->li)	Yes 	@else	No		@endif
	  	</td>
	  	<td>{{ date(Config::get('constants.DATE_FORMAT'), $employee->li) }}</td>
	  	<td>{{ floor(($employee->li-$rating_date)/Config::get('constants.A_DAY')) }}</td>
	  	<td>@if($employee->nin)	Yes 	@else	No		@endif</td>
	  	<td>@if($employee->bank_account)	Yes 	@else	No		@endif</td>
	  	<td>
	  		@foreach($employee->qualities as $quality)
	  			@if(array_search ('Fear of animals', $quality->toArray() ))
		  			Yes
		  			@if($quality->pivot->value!='')
		  				- {{$quality->pivot->value}}
		  			@endif
		  		@endif
	  		@endforeach
	  	</td>
	  	<td>
	  		@foreach($employee->dates as $date)
	  				{{date(Config::get('constants.SHORT_DATE_FORMAT'),$date->start)}} - {{date(Config::get('constants.SHORT_DATE_FORMAT'),$date->end)}}<br />
	  		@endforeach
	  	</td>
	  	<td>{{ $employee->status }}</td>
	  </tr>
	  </a>
	@endforeach
	</tbody>
	</table>