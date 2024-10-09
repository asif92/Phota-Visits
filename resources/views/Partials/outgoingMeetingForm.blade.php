<form action="/storeExternalEvent" method="POST">
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Meeting Title</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="event_title" class="form-control" placeholder="Event Title" maxlength="150" minlength="5" title="Use Minimum 5 letters.">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Meeting Agenda</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="event_description" class="form-control" placeholder="Meeting Agenda" minlength="5" maxlength="200" title="Use Minimum 5 letters.">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Meeting Venue</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="event_venue" class="form-control" placeholder="Meeting Venue" maxlength="150" minlength="5">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-6">
			<label>Meeting Date</label>
			<input type="text" name="event_date" class="form-control datepicker" placeholder="Meeting Date" required="true" readonly="true">
		</div>
		<div class="col-lg-6">
			<label>Meeting Time</label>
			<div class="input-group bootstrap-timepicker timepicker">
				<input type="text" name="event_time" class="form-control input-small" readonly="true" required="true" id="outgoing_time">
				<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-12">
			<label>
				Remarks:
			</label>
			<textarea rows="5" cols="10" class="form-control" style="resize: none;" name="event_remarks">
				
			</textarea>
		</div>
	</div>
	<div class="modal-footer">
		<div class="row form-group">
			<input type="submit" class="btn btn-primary" value="Submit">                 
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>


