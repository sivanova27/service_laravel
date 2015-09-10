@extends('app')
@section('content')
	@include('profile/profile_edit')
	<div role="tabpanel">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#tab1" data-toggle="tab">Rating</a></li>
			<li><a href="#complaint_history" data-toggle="tab">Complaint History</a></li>
			<li><a href="#annual_leaves" data-toggle="tab" class="ajax_page">Annual Leave and Days off History</a></li>
			<li><a href="#positive_feedbacks" data-toggle="tab">Positive feedbacks</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<canvas id="myChart" width="1000" height="200"></canvas>
				<script>
					var chart_labels={!!$labels!!};
					var chart_data={!!$data!!};
				</script>
			</div>
			<div class="tab-pane" id="complaint_history">
				<div class="row">
				<h3>Search for cases:</h3>
					<div class="col-md-2">
						<!-- review types foreach-->
						@if($reviews)
							<ul class="unstyled">
							@foreach($reviews as $review)
								<li>{!!Form::checkbox('review_types[]',$value = $review->id,null,[ 'class' => 'cases'])!!}{!!Form::label('review',$review->name)!!}</li>
							@endforeach
							</ul>
						@endif
					</div>
					<div class="col-md-3">
						<label>From</label>
						<div class="input-append">
							<input type="text" class="date-short cases" name="from" value="{{Input::get('from')}}" readonly="">
							<button class="btn clear" type="button"><i class="icon-trash"></i></button>
						</div>
						<label>To</label>
						<div class="input-append">
							<input type="text" class="date-short cases" name="to" value="{{Input::get('to')}}" readonly="">
							<button class="btn clear" type="button"><i class="icon-music"></i></button>
						</div>
						<script>
							var employee_id = {!!$employee_data->id!!}
						</script>
						<button type="reset" class="btn">Clear</button>
						<button type="submit" name="search" class="btn btn-primary search_case">Search</button>
					</div>
					<div class="result col-md-12"></div>
				</div>
			</div>
			<div class="tab-pane" id="annual_leaves">
				<div class="row"></div>
			</div>
			<div class="tab-pane" id="positive_feedbacks">
				<div class="row"></div>
			</div>
		</div>
	</div>
@endsection
