@extends('layouts.app')


@section('content')
<div class="row">


	<h1 class="text-center">
		{{$event->event_title}}
	</h1>
</div>
<div class="row">
	<div class="col-lg-5">
		<h4>
			<u>Meeting Agenda</u>
		</h4>
	</div>
	<div class="col-lg-6">
		<h4 style="margin-left: 4%;">{!! $event->event_date !!}</h4>
	</div>
</div>
<p>
	{!! $event->event_description !!}
</p>
<h4 style="padding-bottom: 1%;">

	@if($event_name != 'Visit')
	<u>Meeting Participants</u>
	@endif

	@if($event_name == 'Visit')
	<u>Invitee</u>
	@endif


	<button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_new_participant">

		@if($event_name != 'Visit')
		Add New Participant
		@endif

		@if($event_name == 'Visit')
		Add New Invitee
		@endif




	</button>
</h4>
<div class="table-responsive">
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Sr #</th>

				<th>Name</th>
				<th>Department</th>
				<th>Designation</th>
				<th>E-mail</th>

				<th>Contact Number</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($event->MyEventParticipants as $index => $eParticipant)
			@if($eParticipant->status_id == 1)
			<tr style="background-color:gray; color:white;">
				@elseif($eParticipant->status_id == 2)
				<tr style="background-color:lightgray;">
					@else
					@endif
					<td>{{$index +1}}</td>
					<td>{{$eParticipant->participant->participant_name}}</td>
					<td>{{$eParticipant->participant->participant_department}}</td>
					<td>{{$eParticipant->participant->participant_designation}}</td>
					<td>{{$eParticipant->participant->participant_email}}</td>
					<td>{{$eParticipant->participant->participant_contact}}</td>
					<td>
						<button class="btn btn-success btn-xs" onclick="showParticipantEditModal('#edit_participant',{{$eParticipant->participant->id}},{{$event->id}})">
							Edit
						</button>
						<button class="btn btn-danger btn-xs">
							<a href="/deleteParticipant/{{$eParticipant->participant->id}}/{{$event->id}}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
						</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<h4 style="padding-bottom: 1%;">
		<u>Vehicles</u>
		<button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_new_vehicle">
			Add New Vehicle
		</button>
	</h4>
	<div class="table-responsive">
		<table class="table table-hover table-responsive table-striped">
			<thead>
				<tr>
					<th>Sr #</th>
					<th>Vehicle Number</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($event->eventVehicles as $index => $vehicle)
				<tr>
					<td>{{$index+1}}</td>
					<td>{{$vehicle->vehicle->vehicle_registation_number}}</td>
					<td>
						<button class="btn btn-success btn-xs" onclick="showVehicleEditModal('#edit_vehicle',{{$vehicle->vehicle->id}})">
							Edit
						</button>

						<button class="btn btn-danger btn-xs" >

							<a href="/deleteVehicle/{{$vehicle->vehicle->id}}/{{$event->id}}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
						</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>



	<div id="edit_participant" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Edit Participants</h4>
				</div>
				<div class="modal-body">

				</div>

			</div>
		</div>
	</div>


	<div id="delete_participant" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Confirmation</h4>
				</div>
				<div class="modal-body">
					<p>
						Are you sure want to delete?
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default">Yes</button>
					<button type="button" class="btn btn-default">No</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<div id="edit_vehicle" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Edit Vehicle Info</h4>
				</div>
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>


	<div id="delete_vehicle" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Confirmation</h4>
				</div>
				<div class="modal-body">
					<p>
						Are you sure want to delete?
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" onclick="deleteVehicle()">Yes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>





	@endsection



	@section('custom_script')



	<script type="text/javascript">

		function showVehicleEditModal(modal_id,id) {
			$.get('/showVehicle/'+id,function(data){
				var element = "<div class= 'modal_data_div'></div>";
				$('.modal_data_div').remove();
				$(modal_id).find('.modal-body').append(element);
				$('.modal_data_div').append(data);
				$(modal_id).modal('show')
			});
		}



		function showParticipantEditModal(modal_id,id,event_id) {
			$.get('/showParticipant/'+id +'/'+event_id,function(data){
				var element = "<div class= 'modal_data_div'></div>";
				$('.modal_data_div').remove();
				$(modal_id).find('.modal-body').append(element);
				$('.modal_data_div').append(data);
				$(modal_id).modal('show')
			});
		}







	</script>



	@endsection







