@extends('layouts.app')

@section('custom_style')
<link rel="stylesheet" type="text/css" href="{{asset('css/google_map.css')}}">
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="text-center main_heading">
			{{$event_name}}
		</h1>
	</div>
</div>
<!-- <div class="row">
	<div id="map_canvas" style="width:700px; height:500px; margin-left:80px;"></div>
	<div id="map_canvas2" style="width:700px; height:500px; margin-left:80px;"></div>
</div> -->

<div class="row">
	<div class="col-lg-6">
		<button class="btn btn-primary" id="add_new_meeting_map">Add New {{$event_name}}</button>
		<!-- <button class="btn btn-primary" data-toggle="modal" data-target="#add_new_meeting">Add New {{$event_name}}</button> -->
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
							<button class="btn btn-success btn-xs" onclick="showEventEditModal('#edit_meeting',{{$event->id}})">
								Edit
							</button>
							<button class="btn btn-xs btn-primary">
								<a href="{{URL::to('eventDetail')}}/{{$event->id}}" style="color: #fff;">Detail</a>
							</button>
							<button class="btn btn-danger btn-xs">
								<a href="/deleteEvent/{{$event->id}}" onclick="return confirm('Are you sure you want to delete this item?');" style="color: #fff;">Delete</a>
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



	<div id="add_new_meeting" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center modal_heading">Add {{$event_name}}</h4>
				</div>
				<div class="modal-body">
					@include('Partials.meetingForm')
				</div>
			</div>
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
		// function initMap()
		// {
		// 	var myLatlng = new google.maps.LatLng(31.5546, 74.3572);
		// 	var myOptions = {
		// 		zoom: 13,
		// 		center: myLatlng
		// 	}
		// 	var map = new google.maps.Map(document.getElementById("edit_meeting_map"), myOptions);
		// 	var geocoder = new google.maps.Geocoder();

		// 	google.maps.event.addListener(map, 'click', function(event) {
		// 		geocoder.geocode({
		// 			'latLng': event.latLng
		// 		}, function(results, status) {
		// 			if (status == google.maps.GeocoderStatus.OK) {
		// 				if (results[0]) {
		// 					/*alert(results[0].formatted_address);*/
		// 					$('#show_place_name').val(results[0].formatted_address);
		// 				}
		// 			}
		// 		});
		// 	});


		// }

		/*d---------------------------------------*/
		$(function() {
			$( ".datepicker").datepicker({dateFormat : 'dd-MM-yy'});
		});
		// $('#timepicker1').timepicker({
		// 	disableFocus: true
		// });
		var element = $("#timepicker1");
		element.focus(function() { element.timepicker("showWidget")});
		// $('#timepicker1').timepicker().on('timepicker_input.timepicker', function(e) {
		// 	console.log('The time is ' + e.time.value);
		// 	console.log('The hour is ' + e.time.hours);
		// 	console.log('The minute is ' + e.time.minutes);
		// 	console.log('The meridian is ' + e.time.meridian);
		// });
		// $('#timepicker1').timepicker();
		// timepicker1
		// $('#timepicker').timepicker('showWidget');

		$('#add_new_meeting_map').click(function () {
			$('#add_new_meeting').modal({
				show: true
			});
		});

		$('#add_new_meeting').on('shown.bs.modal', function () {
			initMap('map','#show_place_name');
		});

		function showEventEditModal(modal_id,id) {

			$.get('/editEvent/'+id,function(data){
				var element = "<div class= 'modal-body-data'></div>";
				$('.modal-body-data').remove();
				$(modal_id).find('.modal-body').append(element);
				$('.modal-body-data').append(data);
				$(modal_id).modal('show')

			});
		}













		$('#hospitality_check').click(function() {
			if (this.checked) {
				$.get('/hospitalityPackage',function(data){

					var selectList = "<div class='row col-lg-6' id = 'hospitality_package'><div class='col-lg-4'><label>Hospitality Package</label></div><div class='col-lg-8'><select class = 'form-control' name='hospitality_package_id'>";

					for (var x = 0; x < data.length; x++) {
						selectList += "<option value='"+ data[x]['id'] +"'>" + data[x]['package_item_menu'] + "</option>";
					}
					selectList += "</select></div></div>";

					$('#meeting_add_form').find('#hospitality_package_div').append(selectList);


				});
			}else{

				$('#hospitality_package').remove();
			}
		});




		// $('#meeting_add_form').submit(function(event){

		// 	var date = $('#meeting_date_field_id').val();
		// 	var time = $('#timepicker1').val();
		// 	var time_span = $('#meeting_time_span_field_id').val();

		// 	var url = '/meetingDateTimeCheck/add?date='+ date +'&time='+ time + '&time_span='+time_span;
		// 	$.ajax({
		// 		url: url,
		// 		async:false,
		// 		type: ('GET'),
		// 		success: function (data) {
		// 			if (data == "1") {
		// 			}
		// 			else
		// 			{
		// 			}
		// 		}
		// 	});
		// });

		function getSpecificEvents(id,url) {
			location.href ='/' + url +'/'+ $('#'+id).val();
		}



	</script>

	@endsection
