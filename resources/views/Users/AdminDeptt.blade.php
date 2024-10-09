@extends('layouts.app_for_frontDesk')
@section('content')



<h3 class="text-center">Today's Meetings</h3>




<div class="container-fluid" style="padding: 3%;">
	<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 " style="overflow-y: scroll;height: 600px;overflow-x: hidden">
		<ul class="nav nav-stacked" style="margin-right: 2%;" id="admindeptt_meeting_event_ul">

			@foreach($events as $index => $event)
			<li class="active" data-toggle="tab" onclick ="adminDeptSelectedEventId('{{$event->id}}')"  href = "#admindeptt_event_{{$event->id}}" >
				<div class="col-lg-12 add-arrow  firstclass " style="margin-right: 2%;">
					<div class="col-lg-6" style="padding: 3%">
						<label>Sr # : </label><span>{{$index+1}}</span><br>
						<label>Meeting Title : </label><span>{{$event->event_title}}</span><br>
						<label>Venue : </label><span>{{$event->event_venue}}</span>
					</div>
					<div class="col-lg-6" style="padding: 3%">
						<label>Meeting Time : </label><span>{{$event->event_time}}</span><br>
						<label>Agenda : </label><span>{{$event->event_description}}</span><br>
					</div>
				</div>
			</li>
			@endforeach

		</ul>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
		<div class="tab-content " >
			@foreach($events as $index => $event)
			<div id="admindeptt_event_{{$event->id}}" class="tab-pane fade in meeting_attendees">
				<div class="row text-center"><h3>{{$event->event_venue}}</h3></div>
				<h4>Attendes (<b> {{count($event->MyEventParticipants)}} </b>) </h4>
				<div class="table-responsive">
					<table class="table table-hover " id="admindeptt_event_table_{{$event->id}}">
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
								<td style="padding: 0px;"><input type="checkbox" id="admindeptt_event_participant_{{$eParticipant->id}}" onclick="updateEventParticipantList('admindeptt_event_participant_{{$eParticipant->id}}',{{$eParticipant->id}})" checked="" /></td>
							</tr>
							@endif


							@if($eParticipant->status_id == 2)
							<tr style="background-color: {{ $eParticipant->status->status_color }}; color: white">
								<td>{{$index+1}}</td>
								<td>{{$eParticipant->participant->participant_name}}</td>
								<td>{{$eParticipant->participant->participant_contact}}</td>
								<td style="padding: 0px;"><input type="checkbox" id="admindeptt_event_participant_{{$eParticipant->id}}" onclick="updateEventParticipantList('admindeptt_event_participant_{{$eParticipant->id}}',{{$eParticipant->id}})" /></td>
							</tr>
							@endif

							@if($eParticipant->status_id == 1)
							<tr style="background-color: {{ $eParticipant->status->status_color }}">
								<td>{{$index+1}}</td>
								<td>{{$eParticipant->participant->participant_name}}</td>
								<td>{{$eParticipant->participant->participant_contact}}</td>
								<td style="padding: 0px;"><input type="checkbox" id="admindeptt_event_participant_{{$eParticipant->id}}" onclick="updateEventParticipantList('admindeptt_event_participant_{{$eParticipant->id}}',{{$eParticipant->id}})"/></td>
							</tr>
							@endif


							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@endforeach

		</div>
	</div>






</div>


<script type="text/javascript">
	function updateEventParticipantList(checkbox_id,event_part_id) {
		if($('#'+checkbox_id).is(':checked')){
			$.get('/admindepttParticipantArrivalSuccess/'+event_part_id,function(data){
				// alert(data);
			});	
		}
		else
		{
			$.get('/admindepttParticipantArrivalCancel/'+event_part_id,function(data){
				
			});	
		}
	}


	var selected_event_id = "";



	function adminDeptSelectedEventId(id) {
		selected_event_id = id;
		// alert(selected_event_id);
	}	
	

	function AdminDeptWatcher() {
		$.ajax({
			type:'get',
			url: '/AdminDeptWatcher',
			data: {selected_event_id: selected_event_id},
			success: function(data) {
				console.log(data);
				var event_part = data['my_event_participants'];
				
				var table_part = '#admindeptt_event_table_'+selected_event_id+' tbody tr';
				var i = 0;
				$(table_part).each(function() {
					var part_status = event_part[i]['status'];
					if (event_part[i]['status_id'] == 1	) 
					{
						$(this).css('backgroundColor', part_status['status_color']);
						$(this).css('color', '');
						$(this).find('td input[type="checkbox"]').attr('checked', false);
						
					}
					
					else if(event_part[i]['status'] == 2)
					{
						$(this).css('backgroundColor', part_status['status_color']);
						$(this).css('color', 'white');
						// $(this).find('td input[type="checkbox"]').attr('checked', true);
					}

					else
					{
						$(this).css('backgroundColor', part_status['status_color']);
						$(this).css('color', 'white');
						// $(this).find('td input[type="checkbox"]').attr('checked', true);
					}
					i++;

				});
			}
		});

		$.ajax({
			url: '/AdminDeptEventsWatcher',
			success: function(data) {
				
				var table_meeting = '#admindeptt_meeting_event_ul > li > .col-lg-12';
				var x = 0;

				$(table_meeting).each(function() {
					var event_color = data[x]['event_status'];	
					$(this).css('backgroundColor', event_color['event_status_color']);
					x++;
				});
			}
		});



		setTimeout(AdminDeptWatcher, 2000); 
	}

	$(document).ready(function() {
		setTimeout(AdminDeptWatcher, 2000);
	});






</script>





@endsection
