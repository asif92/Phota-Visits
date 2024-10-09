<form method="post" id="meeting_add_form">
	{{ csrf_field() }}
	@if($event_name == 'Visit')
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Inviting Official</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="inviting_official" class="form-control" placeholder="Inviting Official" maxlength="150" minlength="5" title="Use Minimum 5 letters.">
		</div>
	</div>
	@endif

	<div class="row form-group">
		<div class="col-lg-4">
			<label>{{$event_name}} Title</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="event_title" class="form-control" placeholder="{{$event_name}} Title" maxlength="150" minlength="5" title="Use Minimum 5 letters.">
			<input type="hidden" name="event_type_id" value="{{$event_type_id}}">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			@if($event_name != 'Visit')
			<label>{{$event_name}} Agenda</label>
			@endif

			@if($event_name == 'Visit')
			<label>{{$event_name}} Purpose</label>
			@endif


		</div>
		<div class="col-lg-8">
			<textarea name="event_description" class="form-control" placeholder="{{$event_name}} Agenda"></textarea>
		</div>
	</div>

	<div class="row form-group">
		<div class="col-lg-4">
			<label>{{$event_name}} Venue</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="event_venue" id="show_place_name" class="form-control" placeholder="{{$event_name}} Venue" maxlength="150" minlength="5">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-12">
			<div id="map"></div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label>{{$event_name}} Date</label>
			<input type="text" name="event_date" class="form-control datepicker" placeholder="{{$event_name}} Date" required="true" readonly="true" id="meeting_date_field_id">
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label>{{$event_name}} Time</label>
			<div class="input-group bootstrap-timepicker timepicker">
				<input id="timepicker1" type="text" name="event_time" class="form-control input-small timepicker_input" readonly="true" required="true" >
				<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
			</div>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label>Time Span</label>
			<input type="number" name="time_span" class="form-control" placeholder="Time Span in Minutes" required="true" id="meeting_time_span_field_id">
		</div>
	</div>
	<div class="row" style="text-align: center;" id="booking_fail_error">
		<span style="color: red;">Oops ! Slot is booked already. </span>
	</div>




	<div class="row form-group" id="hospitality_package_div">
		<div class="row col-lg-6">
			<div class="col-lg-4">
				<label>Hospitality Status</label>
			</div>
			<div class="col-lg-8">
				<label class="switch">
					<input type="checkbox" name = "hospitality_check" id="hospitality_check" >
					<div class="slider round"></div>
				</label>
			</div>
		</div>
	</div>





	{{-- @if(isset($eventStatus))


		<div class="row form-group">
			<div class="col-lg-4">
				<label>{{$event_name}} Status</label>
			</div>
			<div class="col-lg-8">
				{!!Form::select('event_status_id', $eventStatus, null, ['class' => 'form-control'])!!}
			</div>
		</div>
		@endif --}}


		<div class="row form-group">
			<div class="col-lg-12">
				<label>
					Remarks:
				</label>
				<textarea name="event_remarks" class="form-control" style="resize: none;"></textarea>
			</div>
		</div>



		<div class="modal-footer">
			<div class="row form-group">
				<button id="add_meeting_btn" class="btn btn-primary">Book</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</form>
