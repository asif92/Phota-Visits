<form id="addParticipantForm">
	{{ csrf_field() }}
	@if(isset($event))
	<input type="hidden" name="event_id" class="form-control" value="{{$event->id}}">
	@endif
	<div class="row form-group">
		<div class="col-lg-4">
			@if($event_name != 'Visit')
			<label>Participants Name</label>
			@endif

			@if($event_name == 'Visit')
			<label>Invitee Name</label>
			@endif
		</div>
		<div class="col-lg-8">
			<input type="text" name="participant_name" class="form-control inputText" placeholder="Participants Name" maxlength="50" minlength="3" required="true" title="digits are not allowed.">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			@if($event_name != 'Visit')
			<label>Participants Department</label>
			@endif

			@if($event_name == 'Visit')
			<label>Invitee Department</label>
			@endif
		</div>
		<div class="col-lg-8">
			<input type="text" name="participant_department" class="form-control inputText" placeholder="Department">
		</div>
	</div>

	<div class="row form-group">
		<div class="col-lg-4">
			@if($event_name != 'Visit')
			<label>Participants Designation</label>
			@endif

			@if($event_name == 'Visit')
			<label>Invitee Designation</label>
			@endif
		</div>
		<div class="col-lg-8">
			<input type="text" name="participant_designation" class="form-control inputText" placeholder="Designation">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			@if($event_name != 'Visit')
			<label>Participants E-mail</label>
			@endif

			@if($event_name == 'Visit')
			<label>Invitee E-mail</label>
			@endif
		</div>
		<div class="col-lg-8">
			<input type="email" name="participant_email" class="form-control" placeholder="E-mail">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Contact Number</label>
		</div>
		<div class="col-lg-8">
			<input type="number" name="participant_contact" class="form-control contact" placeholder="Contact Number" onkeypress='validate(event)'>
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

			<button type="button" class="btn btn-primary" onclick="postParticipantForm()">Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Close</button>
		</div>
	</div>
</form>
<div class="modal fade" id="addMoreParticipant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">Confirmation</h4>
			</div>
			<div class="modal-body row text-center" style="padding-bottom: 5%;">
				<p class="text-center">
					Participant has been added successfully.
				</p>
				<p class="text-center">
					Do you want to add more participant??
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="addParticipantYes()">Yes</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">No</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Close</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	function postParticipantForm() {
		var url = '/addParticipant';
		var postData = "text";
		$.ajax({
			type: "post",
			url: url,
			data: $('#addParticipantForm').serialize(),
			contentType: "application/x-www-form-urlencoded",
			success: function(responseData, textStatus, jqXHR) {
				$("#addMoreParticipant").modal('show');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		})
	}
	function addParticipantYes()
	{
		$('#addParticipantForm')[0].reset();
		$("#addMoreParticipant").modal('hide');
		$("#add_new_participant").modal('show');
	}
</script>



