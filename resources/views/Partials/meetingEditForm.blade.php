

<form  method="post" id="meeting_edit_form">
	{{ csrf_field() }}
	<input type="hidden" name="event_id" value="{{$event->id}}">

	@if($event_name == 'Visit')
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Inviting Official</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="inviting_official" class="form-control" placeholder="Inviting Official" maxlength="150" minlength="5" title="Use Minimum 5 letters." value="{{$event->inviting_official}}">
		</div>
	</div>
	@endif


	<div class="row form-group">
		<div class="col-lg-4">
			<label>{{$event_name}} Title</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="event_title" class="form-control" value="{{$event->event_title}}" maxlength="150" minlength="5" title="Use Minimum 5 letters.">
			<input type="hidden" name="event_type_id" value="{{$event->event_type_id}}">
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
			<textarea name="event_description" class="form-control" style="resize: none;"> {!! $event->event_description !!} </textarea>
		</div>



	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>{{$event_name}} Venue</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="event_venue" id="edit_show_place_name" class="form-control inputText" value="{{$event->event_venue}}" maxlength="150" minlength="5">
		</div>
	</div>

	<div class="row form-group">
		<div class="col-lg-12">
			<div id="map_edit" style="height: 400px;"></div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>{{$event_name}} Date</label>
			<input type="text" name="event_date" class="form-control datepicker" value="{{$event->event_date}}" required="true" readonly="true" id="meeting_edit_date_field_id">
		</div>
		<div class="col-lg-4">
			<label>{{$event_name}} Time</label>
			<div class="input-group bootstrap-timepicker timepicker">
				<input id="timepicker2" type="text" name= "event_time" class="form-control input-small" readonly="true" value="{{$event->event_time}}" required="true">
				<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
			</div>
		</div>

		<div class="col-lg-4">
			<label>Time Span</label>
			<input type="number" name="time_span" class="form-control" value="{{$event->time_span}}" required="true" id="meeting_edit_time_span_field_id">
		</div>
	</div>
	<div class="row" style="text-align: center;" id="booking_edit_fail_error">
		<span style="color: red;">Oops ! Slot is booked already. </span>
	</div>

	<div class="row form-group" id="hospitality_package_div_edit">
		<div class="row col-lg-6">
			<div class="col-lg-4">
				<label>Hospitality Status</label>
			</div>
			<div class="col-lg-8">
				<label class="switch">
					@if($event->hospitality_allowed == 1)
					<input type="checkbox" name = "hospitality_check" id="hospitality_check_edit" checked="">
					<div class="slider round"></div>
					@endif

					@if($event->hospitality_allowed == 0)
					<input type="checkbox" name = "hospitality_check" id="hospitality_check_edit" >
					<div class="slider round"></div>
					@endif

				</label>
			</div>
		</div>

		@if($event->hospitality_allowed != 0)
		<div class="row col-lg-6" id="hospitality_package_edit_meeting">
			<div class="col-lg-4">
				<label>Hospitality Status</label>
			</div>
			<div class="col-lg-8">
				{!!Form::select('hospitality_package_id', $hospitality_pack, $event->hospitality_package_id, ['class' => 'form-control'])!!}

			</div>
		</div>
		@endif
	</div>


	{{-- <div class="row form-group">
	<div class="col-lg-4">
		<label>{{$event_name}} Status</label>
	</div>
	<div class="col-lg-8">
		{!!Form::select('event_status_id', $eventStatus, $event->event_status_id, ['class' => 'form-control'])!!}
	</div>
</div> --}}

<div class="row form-group">
	<div class="col-lg-12">
		<label>
			Remarks:
		</label>
		<textarea name="event_remarks" class="form-control"  style="resize: none;" >{!! $event->event_remarks !!}</textarea>
	</div>
</div>


<div class="modal-footer">
	<div class="row form-group">

		<button id="update_meeting_btn" class="btn btn-primary">Book</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div>
</form>

<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> -->


<script type="text/javascript">

	$('#hospitality_check_edit').click(function() {
		if (this.checked) {

			$.get('/hospitalityPackage',function(data){
				var selectList = "<div class='row col-lg-6' id = 'hospitality_package_edit_meeting'><div class='col-lg-4'><label>Hospitality Package</label></div><div class='col-lg-8'><select class = 'form-control' name='hospitality_package_id'>";
				for (var x = 0; x < data.length; x++) {
					selectList += "<option value='"+ data[x]['id'] +"'>" + data[x]['package_item_menu'] + "</option>";
				}
				selectList += "</select></div></div>";
				$('#meeting_edit_form').find('#hospitality_package_div_edit').append(selectList);
			});

		}else{
			$('#hospitality_package_edit_meeting').remove();
		}
	});

	$(function() {
		$( ".datepicker" ).datepicker({dateFormat : 'dd-MM-yy'});
	});

	$('#timepicker2').timepicker();

	$('#edit_meeting').on('shown.bs.modal', function () {

		initMap('map_edit','#edit_show_place_name');
	});

	$('#meeting_edit_form').submit(function(event){

		var date = $('#meeting_edit_date_field_id').val();
		var time = $('#timepicker2').val();
		var time_span = $('#meeting_edit_time_span_field_id').val();

		var url = '/meetingDateTimeCheck/edit?date='+ date +'&time='+ time + '&time_span='+time_span;
		$.ajax({
			url: url,
			async:false,
			type: ('GET'),
			success: function (data) {
				// alert(data);
				if (data == "1") {
				} else {

				}
			}
		});
	});


	$(document).ready(function() {
		var base_url =  window.location.origin;


		$("#booking_edit_fail_error").hide();
		$( "#update_meeting_btn" ).click(function(e) {
			e.preventDefault();
	    var url = base_url + "/updateEvent"; // the script where you handle the form input.
	    $.ajax({
	    	type: "POST",
	    	url: url,
	           data: $("#meeting_edit_form").serialize(), // serializes the form's elements.
	           success: function(data)
	           {


	           	console.log(JSON.stringify(data));
	           	if (data == "no slot") {
	           		$("#booking_edit_fail_error").show();
	           	}else{
	           		$('#edit_meeting').modal("hide");
	           		$("#meeting_edit_form") [0].reset();
	           		location.reload();

	           	}
	           }
	       });
	});
	});
</script>