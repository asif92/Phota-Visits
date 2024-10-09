@extends('layouts.app_for_frontDesk')
@section('content')

<h3 class="text-center gatekeeper_top_heading">Today's Meetings</h3>


<div class="container-fluid" style="padding: 3%;">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 " style="overflow-y: scroll;height: 600px;overflow-x: hidden" >
			<ul class="nav nav-stacked" style="margin-right: 2%;" id="gatekeeper_meeting_event_ul">
				@foreach($events as $index => $event)

				<li class="active" data-toggle="tab" onclick ="gateKeeperSelectedEventId('{{$event->id}}')" href = "#gatekeeper_event_{{$event->id}}" >
					<div class="col-lg-12 add-arrow  firstclass " style="margin-right: 2%;">
						<div class="col-lg-6" style="padding: 3%">
							<label>Sr # : </label><span>{{$index+1}}</span><br>
							<label>Meeting Title : </label><span>{{$event->event_title}}</span><br>
						</div>
						<div class="col-lg-6" style="padding: 3%">
							<label>Meeting Time : </label><span>{{$event->event_time}}</span><br>

							<label>Venue : </label><span>{{$event->event_venue}}</span>
						</div>

					</div>
				</li>

				@endforeach

			</ul>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
			<div class="tab-content ">

				@foreach($events as $index => $event)
				<div id="gatekeeper_event_{{$event->id}}" class="tab-pane fade in meeting_attendees ">
					<div class="row text-center"><h3>{{$event->event_venue}}</h3></div>
					<h4>Attendes (<b> {{count($event->MyEventParticipants)}} </b>) </h4>
					<div class="table-responsive">
						<table class="table table-hover  " id="gatekeeper_event_table_{{$event->id}}">
							<thead>
								<tr>
									<th>Sr # </th>
									<th>Name</th>
									<th>Contact</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

								@foreach($event->MyEventParticipants as $index => $eParticipant)
								@if($eParticipant->status_id == 3)
								<tr style="background-color: {{ $eParticipant->status->status_color }}; color: white">
									<td>{{$index+1}}</td>
									<td>{{$eParticipant->participant->participant_name}}</td>
									<td>{{$eParticipant->participant->participant_contact}}</td>
									<td >
										<input type="checkbox" id="gatekeeper_event_participant_{{$eParticipant->id}}" onclick="updateEventParticipantList('gatekeeper_event_participant_{{$eParticipant->id}}',{{$eParticipant->id}})"
										disabled="true"
										checked="true"
										>
									</td>
								</tr>
								@endif

								@if($eParticipant->status_id == 2)
								<tr style="background-color: {{ $eParticipant->status->status_color }};color: white">
									<td>{{$index+1}}</td>
									<td>{{$eParticipant->participant->participant_name}}</td>
									<td>{{$eParticipant->participant->participant_contact}}</td>
									<td >
										<input type="checkbox" id="gatekeeper_event_participant_{{$eParticipant->id}}" onclick="updateEventParticipantList('gatekeeper_event_participant_{{$eParticipant->id}}',{{$eParticipant->id}})"
										checked="true"
										>
									</td>
								</tr>
								@endif


								@if($eParticipant->status_id == 1)
								<tr style="background-color: {{ $eParticipant->status->status_color }}">
									<td>{{$index+1}}</td>
									<td>{{$eParticipant->participant->participant_name}}</td>
									<td>{{$eParticipant->participant->participant_contact}}</td>
									<td >
										<input type="checkbox" id="gatekeeper_event_participant_{{$eParticipant->id}}" onclick="updateEventParticipantList('gatekeeper_event_participant_{{$eParticipant->id}}',{{$eParticipant->id}})"

										>
									</td>

								</tr>
								@endif


								@endforeach
							</tbody>
						</table>
					</div>
















					@if(count($event->eventVehicles) !=0)
					<h3>vehicles ( {{count($event->eventVehicles)}} ) </h3>
					<div class="table-responsive">
						<table class="table table-hover " id="gatekeeper_vehicle_table_{{$event->id}}">
							<thead>
								<tr>
									<th>Sr # </th>
									<th>Vehicles Number</th>
									<th>Action</th>

								</tr>
							</thead>
							<tbody>
								@foreach($event->eventVehicles as $index => $eVehicle)

								@if($eVehicle->status_id == 1)
								<tr style="background-color: {{ $eVehicle->status->status_color }}">
									<td>{{$index+1}}</td>
									<td>{{$eVehicle->vehicle->vehicle_registation_number}}</td>
									<td><input type="checkbox" name="" id="gatekeeper_event_vehicle_{{$eVehicle->id}}" onclick="updateEventVehicleList('gatekeeper_event_vehicle_{{$eVehicle->id}}',{{$eVehicle->id}})"></td>
								</tr>
								@endif

								@if($eVehicle->status_id == 2)
								<tr style="background-color: {{ $eVehicle->status->status_color }};color: white">
									<td>{{$index+1}}</td>
									<td>{{$eVehicle->vehicle->vehicle_registation_number}}</td>
									<td><input type="checkbox" name="" id="gatekeeper_event_vehicle_{{$eVehicle->id}}" checked="" onclick="updateEventVehicleList('gatekeeper_event_vehicle_{{$eVehicle->id}}',{{$eVehicle->id}})"></td>
								</tr>
								@endif



								@endforeach
							</tbody>

						</table>
					</div>
					@endif

				</div>

				@endforeach

			</div>
		</div>

	</div>
</div>




<script type="text/javascript">

	function updateEventParticipantList(checkbox_id,event_part_id) {
		if($('#'+checkbox_id).is(':checked')){
			$.get('/gatekeeperParticipantArrivalSuccess/'+event_part_id,function(data){
			});
		}
		else
		{
			$.get('/gatekeeperParticipantArrivalCancel/'+event_part_id,function(data){
			});
		}
	}

	function updateEventVehicleList(checkbox_id,event_vehicle_id) {
		if($('#'+checkbox_id).is(':checked')){
			$.get('/gatekeeperVehicleArrivalSuccess/'+event_vehicle_id,function(data){
			});
		}
		else
		{
			$.get('/gatekeeperVehicleArrivalCancel/'+event_vehicle_id,function(data){
			});
		}
	}
	var selected_event_id = "";

	function gateKeeperSelectedEventId(id) {
		selected_event_id = id;
		// alert(selected_event_id);
	}


	function GateKeeperWatcher() {
		$.ajax({
			type:'get',
			url: '/GateKeeperWatcher',
			data: {selected_event_id: selected_event_id},
			success: function(data) {
				console.log(data);
				var event_part = data['my_event_participants'];

				var table_part = '#gatekeeper_event_table_'+selected_event_id+' tbody tr';
				var i = 0;
				$(table_part).each(function() {
					var part_status = event_part[i]['status'];
					if (event_part[i]['status_id'] == 1	)
					{
						$(this).css('backgroundColor', part_status['status_color']);
						$(this).find('td input[type="checkbox"]').attr('checked',false);
						$(this).find('td input[type="checkbox"]').prop("disabled", false);
						$(this).css('color', '');
					}
					else if(event_part[i]['status'] == 2)
					{

						$(this).css('backgroundColor', part_status['status_color']);
						$(this).css('color', 'white');

						$(this).find('td input[type="checkbox"]').attr('checked', true);
						$(this).find('td input[type="checkbox"]').prop("disabled", false);
					}
					else
					{
						$(this).css('backgroundColor', part_status['status_color']);
						$(this).css('color', 'white');
						$(this).find('td input[type="checkbox"]').attr('checked', true);
						$(this).find('td input[type="checkbox"]').prop("disabled", true);
					}
					i++;

				});

				var table_vehicle = '#gatekeeper_vehicle_table_'+selected_event_id+' tbody tr';

				var event_vehicle = data['event_vehicles'];
				var j = 0;
				$(table_vehicle).each(function() {
					var vehicle_status = event_vehicle[j]['status'];
					if (event_vehicle[j]['status_id'] == 1	)
					{
						$(this).css('backgroundColor', vehicle_status['status_color']);
						$(this).find('td input[type="checkbox"]').attr('checked', false);
						$(this).css('color', '');
					}
					else if(event_vehicle[j]['status'] == 2	)
					{
						$(this).css('backgroundColor', vehicle_status['status_color']);
						$(this).css('color', 'white');
						$(this).find('td input[type="checkbox"]').attr('checked', true);
					}
					else
					{
						$(this).css('backgroundColor', vehicle_status['status_color']);
						$(this).css('color', 'white');
						$(this).find('td input[type="checkbox"]').attr('checked', true);
						$(this).find('td input[type="checkbox"]').attr('disable', true);
					}
					j++;

				});


				// var starttime= new Date("2017-06-23 10:00:00");
				// starttime = starttime.getTime();

				// var endtime= new Date();
				// endtime = endtime.getTime();
				// var diff = endtime - starttime;

				// var time_diff = diff / 60000;
			}
		});

		$.ajax({
			url: '/GateKeeperEventsWatcher',
			success: function(data) {

				var table_meeting = '#gatekeeper_meeting_event_ul > li > .col-lg-12';
				var x = 0;

				$(table_meeting).each(function() {
					var event_color = data[x]['event_status'];
					$(this).css('backgroundColor', event_color['event_status_color']);
					x++;
				});
			}
		});


		setTimeout(GateKeeperWatcher, 2000);
	}

	$(document).ready(function() {
		setTimeout(GateKeeperWatcher, 2000);
	});








</script>






@endsection