@extends('layouts.app_for_frontDesk')

@section('content')
<h3 class="text-center">Today's Meetings</h3>
<div class="container-fluid" style="padding: 3%;">
	<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 " style="overflow-y: scroll;height: 600px;overflow-x: hidden">
		<ul class="nav nav-stacked" style="margin-right: 2%;" id="helpdesk_meeting_event_ul">
			@foreach($events as $index => $event)
			<li class="active" data-toggle="tab" href = "#helpdesk_event_{{$event->id}}" onclick = "helpDeskSelectedEventId('{{$event->id}}')" >
				<div class="col-lg-12 add-arrow  firstclass " style="margin-right: 2%;">
					<div class="col-lg-6" style="padding: 3%">
						<label>Sr # : </label><span>{{$index+1}}</span><br>
						<label>Meeting Title : </label><span>{{$event->event_title}}</span><br>
						<label>Venue : </label><span>{{$event->event_venue}}</span>
					</div>
					<div class="col-lg-6" style="padding: 3%">
						<label>Meeting Time : </label><span>{{$event->event_time}}</span><br>
						<label>Meeting Date : </label><span>{{$event->event_date}}</span><br>
					</div>
				</div>
			</li>
			@endforeach

		</ul>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
		<div class="tab-content " style="border: solid #3c8dbc;padding: 5% 4%">
			@foreach($events as $index => $event)
			<div id="helpdesk_event_{{$event->id}}" class="tab-pane fade in meeting_attendees">
				<div class="row text-center"><h3>{{$event->event_venue}}</h3></div>
				<h4>Attendes (<b> {{count($event->MyEventParticipants)}} </b>) </h4>
				<div class="table-responsive">
					<table class="table table-hover  table-striped" id="helpdesk_event_table_{{$event->id}}">
						<thead>
							<tr>
								<th>Arrived</th>
								<td id="arrived_participant_{{$event->id}}">
									@foreach($arrived_part as $index_1 => $event_arrived_part)
									@if($event_arrived_part->id == $event->id)
									{{count($event_arrived_part->MyEventParticipants)}}
									@endif
									@endforeach
								</td>
							</tr>

							<tr>
								<th>Remaining</th>
								<td id="remaining_participant_{{$event->id}}">
									@foreach($remaining_part as $index_2 => $event_remaining_part)
									@if($event_remaining_part->id == $event->id)
									{{count($event_remaining_part->MyEventParticipants)}}
									@endif
									@endforeach
								</td>
							</tr>

							<tr>
								<th>Total </th>
								<td id="total_participant_{{$event->id}}">
									{{$total_part}}
								</td>
							</tr>
							{{--
								<thead>
									<tr>
										<th>Arrived</th>
										<td id="arrived_participant_{{$event->id}}">{{count($arrived_part[$index]->MyEventParticipants)}}</td>
									</tr>
									<tr>
										<th>Remaining</th>
										<td id="remaining_participant_{{$event->id}}">{{count($remaining_part[$index]->MyEventParticipants)}}</td>
									</tr>
									<hr>
									<tr>
										<th>Total </th>
										<td id="total_participant_{{$event->id}}">{{count($arrived_part[$index]->MyEventParticipants) + count($remaining_part[$index]->MyEventParticipants)}}</td>
									</tr>
								</thead>
								--}}


							</thead>
						</table>
					</div>
				</div>
				@endforeach

			</div>
		</div>

	</div>


	<script type="text/javascript">
		var selected_event_id = "";



		function helpDeskSelectedEventId(id) {
			selected_event_id = id;
		// alert(selected_event_id);
	}	
	

	function HelpDeskWatcher() {
		$.ajax({
			type:'get',
			url: '/HelpDeskWatcher',
			data: {selected_event_id: selected_event_id},
			success: function(data) {
				console.log(data);
				var table_part = '#helpdesk_event_table_'+selected_event_id+' thead tr';
				$(table_part).each(function() {
					$(this).find('#arrived_participant_'+selected_event_id).html(data['arrived_part']);
					$(this).find('#remaining_participant_'+selected_event_id).html(data['remaining_part']);
					$(this).find('#total_participant_'+selected_event_id).html(data['total_part']);
				});
			}
		});


		$.ajax({
			url: '/HelpDeskEventsWatcher',
			success: function(data) {
				
				var table_meeting = '#helpdesk_meeting_event_ul > li > .col-lg-12';
				var x = 0;

				$(table_meeting).each(function() {
					var event_color = data[x]['event_status'];	
					$(this).css('backgroundColor', event_color['event_status_color']);
					x++;
				});
			}
		});

		setTimeout(HelpDeskWatcher, 2000); 
	}

	$(document).ready(function() {
		// setTimeout(HelpDeskWatcher, 2000);

	});


</script>




@endsection