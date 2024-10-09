@extends('layouts.app_for_frontDesk')

@section('content')



<div id="exTab1" class="container">
	<ul  class="nav nav-pills">
		<li>
			<a href="#1a" data-toggle="tab" onclick="getTodayEvents()">Today's Meetings</a>
		</li>
		<li class="active">
			<a href="#2a" data-toggle="tab" onclick="getUpcomingEvents()">Upcoming Meetings</a>
		</li>
	</ul>

	<div class="tab-content clearfix" style="padding: 0%;">
		<div class="tab-pane" id="1a">
			<h3 class="text-center">Today's Meetings</h3>
		</div>
		<div class="tab-pane active" id="2a">
			<h3 class="text-center">Upcoming Meetings</h3>
			<div class="container-fluid">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="overflow-y: scroll;height: 600px;overflow-x: hidden" id="upcomingAppointmentData">
					<table class="table">
						<thead>
							<tr>
								<th>Sr</th>
								<th>Meeting Title</th>
								<th>Venue</th>
								<th>Date</th>
								<th>Time</th>
								<th>Total Attendees</th>
								<th>Hospitality Package</th>
							</tr>
						</thead>
						<tbody>
							@foreach($events as $index => $event)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$event->event_title}}</td>
								<td>{{$event->event_venue}}</td>
								<td>{{$event->event_date}}</td>
								<td>{{$event->event_time}}</td>
								<td class="text-center"> {{count($event->MyEventParticipants)}} </td>
								<td class="text-center">{{$event->hospitality_package_id}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	var selected_event_id = "";
	function hospitalitySelectedEventId(id) {
		selected_event_id = id;
		// alert(selected_event_id);
	}

	function HospitalityWatcher() {
		$.ajax({
			url: '/HospitalityWatcher/'+selected_event_id,
			success: function(data) {
				console.log(data);
				var table_part = '#admindeptt_event_'+selected_event_id+' thead tr';
				$(table_part).each(function() {
					$(this).find('#arrived_participant_'+selected_event_id).html(data['arrived_part']);
					$(this).find('#remaining_participant_'+selected_event_id).html(data['remaining_part']);
					$(this).find('#total_participant_'+selected_event_id).html(data['total_part']);
				});
			}
		});
		$.ajax({
			url: '/HospitalityEventsWatcher',
			success: function(data) {
				var table_meeting = '#hospitality_meeting_event_ul > li > .col-lg-12';
				var x = 0;
				$(table_meeting).each(function() {
					var event_color = data[x]['event_status'];
					$(this).css('backgroundColor', event_color['event_status_color']);
					x++;
				});
			}
		});
		setTimeout(HospitalityWatcher, 2000);
	}

	$(document).ready(function() {
		setTimeout(HospitalityWatcher, 2000);


	});


	function getTodayEvents() {
		location.href ='/hospitality';
		// $.ajax({
		// 	url: 'getupcomingevents',
		// 	type: "get",
		// 	success: function(data){
		// 		$("#upcomingAppointmentData").append(data);
		// 	}
		// });
	}


</script>





@endsection