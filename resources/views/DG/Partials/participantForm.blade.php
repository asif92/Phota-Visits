<form action="/addParticipant" method="POST">
	{{ csrf_field() }}
	@if(isset($event))
	<input type="hidden" name="event_id" class="form-control" value="{{$event->id}}">
	@endif
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Participants Name</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="participant_name" class="form-control inputTextBox inputText" placeholder="Participants Name" maxlength="30" minlength="3" required="true" title="digits are not allowed.">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Contact Number</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="participant_contact" class="form-control contact" placeholder="Contact Number" onkeypress='validate(event)' data-masked-input="(9999) 9999999">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Address</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="participant_address" class="form-control" placeholder="Address" maxlength="200" minlength="5">
		</div>
	</div>

	@if(isset($status))


	<div class="row form-group">
		<div class="col-lg-4">
			<label>Status</label>
		</div>
		<div class="col-lg-8">
			{!!Form::select('status_id', $status, null, ['class' => 'form-control'])!!}
		</div>
	</div>
	@endif


	<div class="modal-footer">
		<div class="row form-group">
			<input type="submit" class="btn btn-primary" value="Submit">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>