<form action="/updateParticipant" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="id" value="{{$participant->id}}">

	<input type="hidden" name="event_part_id" value="{{$part_status->id}}">

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
			<input type="text" name="participant_name" class="form-control inputTextBox inputText" value="{{$participant->participant_name}}" placeholder="Participants Name" maxlength="30" minlength="3" required="true" title="digits are not allowed.">
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
			<input type="text" name="participant_department" value="{{$participant->participant_department}}" class="form-control" placeholder="Department">
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
			<input type="text" name="participant_designation" value="{{$participant->participant_designation}}" class="form-control" placeholder="Designation">
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
			<input type="email" name="participant_email" value="{{$participant->participant_email}}" class="form-control" placeholder="E-mail">
		</div>
	</div>


	<div class="row form-group">
		<div class="col-lg-4">
			<label>Contact Number</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="participant_contact" class="form-control contact" value="{{$participant->participant_contact}}" placeholder="Contact Number" onkeypress='validate(event)' data-masked-input="(99999) 9999999">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Status</label>
		</div>
		<div class="col-lg-8">
			{!!Form::select('status_id', $status, $part_status->status_id, ['class' => 'form-control'])!!}
		</div>
	</div>

	<div class="modal-footer">
		<div class="row form-group">
			<input type="submit" class="btn btn-primary" value="Submit">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>





<script type="text/javascript">
	jQuery(function($){
		$(".contact").mask("(999) 9999999");
	});
	function alpha(e) {
		var k;
		document.all ? k = e.keyCode : k = e.which;
		return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8);
	}
	$(document).ready(function() {
		$('.inputText').on('keypress', function (event) {
			var regex = new RegExp("^[a-z A-Z0-9]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		});

		$(".inputTextBox").keypress(function(event){
			var inputValue = event.which;
            // allow letters and whitespaces only.
            if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
            	event.preventDefault();
            }
        });
	});
</script>