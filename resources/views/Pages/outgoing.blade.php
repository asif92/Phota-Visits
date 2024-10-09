@extends('layouts.app')


@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="text-center main_heading">
			Outgoing Meetings
		</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<button class="btn btn-primary" data-toggle="modal" data-target="#add_new_outgoing_meeting">Add New Meeting</button>
	</div>
</div>

<div class="row">
	<div class="table-responsive" >
		<table class="table table-hover table-striped" id="eventTable">
			<thead>
				<tr>
					<th>Sr #</th>
					<th>Meeting Title</th>
					<th>Meeting Agenda</th>
					<th>Meeting Venue</th>
					<th>Meeting Date & Time</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@foreach ($events as $index => $event)
				<tr>
					<td>{{$index+1}}</td>
					<td>{{$event->event_title}}</td>
					<td>{{$event->event_description}}</td>
					<td>{{$event->event_venue}}</td>
					<td>{{$event->event_date}} at {{$event->event_time}}</td>
					<td>
						<button class="btn btn-success btn-xs"  onclick="showExternalEventEditModal('#edit_outgoing_meeting',{{$event->id}})">
							Edit
						</button>
						<button class="btn btn-xs btn-danger">
							<a href="/deleteExternalEvent/{{$event->id}}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
						</button>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>
	</div>
</div>



<div id="add_new_outgoing_meeting" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center modal_heading">Add outgoing meeting detail</h4>
			</div>
			<div class="modal-body">
				@include('Partials.outgoingMeetingForm')
			</div>
		</div>
	</div>
</div>

<div id="edit_outgoing_meeting" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center modal_heading">Edit outgoing meeting detail</h4>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>



@endsection



@section('custom_script')

<script type="text/javascript">
	$(function() {
		$( ".datepicker" ).datepicker({dateFormat : 'dd-MM-yy'});
	});
    // $( '#datepicker' ).datepicker({dateFormat : 'dd-MM-yy'});
    // $('#outgoing_time').timepicker();
    // $('#outgoing_time2').timepicker();
    var element = $("#outgoing_time");
    element.focus(function() { element.timepicker("showWidget")});
    var element2 = $("#outgoing_time2");
    element2.focus(function() { element2.timepicker("showWidget")});

    function showExternalEventEditModal(modal_id,id) {
    	$.get('/editExternalEvent/'+id,function(data){
    		var element = "<div class= 'modal_data_div'></div>";
    		$('.modal_data_div').remove();
    		$(modal_id).find('.modal-body').append(element);
    		$('.modal_data_div').append(data);
    		$(modal_id).modal('show')
    	});
    }


    // $( '#datepicker2' ).datepicker({dateFormat : 'dd-MM-yy'});
</script>

@endsection
