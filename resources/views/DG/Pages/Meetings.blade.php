@extends('DG.layouts.app')


@section('content')


<div class="row">
	<div class="col-lg-12">
		<h1 class="text-center main_heading">
			{{$event_name}}
		</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
	</div>
	<div class="col-lg-3 col-lg-offset-3">
		<select name="event_type" class="form-control" onclick="getSpecificEvents('event_type_data','{{$current_URL}}')" id="event_type_data">
			<option  <?php if ($selected_event_type == 'today') {
	echo 'selected';
}
?> value="today" >Today</option>
			<option <?php if ($selected_event_type == 'upcoming') {
	echo 'selected';
}
?> value="upcoming">Upcoming</option>
			<option <?php if ($selected_event_type == 'all') {
	echo 'selected';
}
?> value="all">All</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="table-responsive" >
		<table class="table table-hover table-striped" id="eventTable">
			<thead>
				<tr>
					<th>Sr #</th>
					<th>{{$event_name}} Title</th>
					@if($event_name != 'Visit')
					<th>{{$event_name}} Agenda</th>
					@endif

					@if($event_name == 'Visit')
					<th>{{$event_name}} Purpose</th>
					@endif


					<th>{{$event_name}} Venue</th>
					<th>{{$event_name}} Date & Time</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($events as $index => $event)
				@if($event->event_status_id == 5)
				<tr style="background-color: red;">
					@endif
					@if($event->event_status_id != 5)
					<tr>
						@endif
						<td>{{$index+1}}</td>
						<td>{{$event->event_title}}
							@if($event->MyEventParticipants!='[]')
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Participant Name</th>
										<th>Department</th>
										<th>Designation</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($event->MyEventParticipants as $index => $myParticipant)
									<tr>
										<td>{{$index+1}}</td>
										<td>
											{{$myParticipant->participant->participant_name}}
										</td>
										<td>
											{{$myParticipant->participant->participant_department}}
										</td>
										<td>
											{{$myParticipant->participant->participant_designation}}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							@endif
						</td>
						<td>{!! $event->event_description !!}</td>
						<td>{{$event->event_venue}}</td>
						<td>{{$event->event_date}} at {{$event->event_time}}</td>
						<td>
							<button class="btn btn-xs btn-success">
								<a href="/superadmin/meetingApproval/{{$event->id}}/1" style="color: #fff;">Approve</a>
							</button>

							<button class="btn btn-xs btn-danger">
								<a href="/superadmin/meetingApproval/{{$event->id}}/2" style="color: #fff;">Cancel</a>
							</button>

							<button class="btn btn-xs btn-primary">
								<a href="/superadmin/meetingApproval/{{$event->id}}/3" style="color: #fff;">Postpone</a>
							</button>
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>
		</div>
		<div class="text-center">
			{!! $events->links() !!}
		</div>
	</div>







	<div id="edit_meeting" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Edit {{$event_name}}</h4>
				</div>
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>





	@endsection



	@section('custom_script')

	<script type="text/javascript">

		function getSpecificEvents(id,url) {
			location.href ='/' + url +'/'+ $('#'+id).val();
		}
	</script>

	@endsection
