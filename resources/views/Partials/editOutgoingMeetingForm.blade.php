<form action="/updateExternalEvent" method="post" id="external_meeting_edit_form">
	
	{{ csrf_field() }}
	<input type="hidden" name="event_id" value="{{$event->id}}">
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Meeting Title</label>
		</div>
		<div class="col-lg-8">
			<input type="text"  class="form-control" placeholder="Event Title" maxlength="150" minlength="5" title="Use Minimum 5 letters." value="{{$event->event_title}}" name="event_title">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Meeting Agenda</label>
		</div>
		<div class="col-lg-8">
			<input type="text" class="form-control" placeholder="Meeting Agenda" minlength="5" maxlength="200" title="Use Minimum 5 letters." value="{{$event->event_description}}" name="event_description">
		</div>
	</div>

	<div class="row form-group">
		<div class="col-lg-4">
			<label>Meeting Venue</label>
		</div>
		<div class="col-lg-8">
			<input type="text" class="form-control" placeholder="Meeting Venue" maxlength="150" minlength="5" value="{{$event->event_venue}}" name="event_venue">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-6">
			<label>Meeting Date</label>
			<input type="text" class="form-control datepicker" placeholder="Meeting Date" required="true" readonly="true" value="{{$event->event_date}}" name="event_date">
		</div>
		<div class="col-lg-6">
			<label>Meeting Time</label>
			<div class="input-group bootstrap-timepicker timepicker">
				<input type="text" class="form-control input-small" readonly="true" required="true" id="outgoing_time2" value="{{$event->event_time}}" name="event_time">
				<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-12">
			<label>
				Remarks:
			</label>
			<textarea rows="5" cols="10" class="form-control" style="resize: none;" name="event_remarks">{{$event->event_remarks}}</textarea>
		</div>
	</div>
	<div class="modal-footer">
		<div class="row form-group">
			<input type="submit" class="btn btn-primary" value="Submit">                 
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>


