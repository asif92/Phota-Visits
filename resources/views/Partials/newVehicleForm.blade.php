<form action="/addVehicle" method="POST">

	{{ csrf_field() }}
	@if(isset($event))
	<input type="hidden" name="event_id" class="form-control" value="{{$event->id}}">
	@endif
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Vehicle Number</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="vehicle_registation_number" class="form-control vehicle" placeholder="Vehicle Number" required="true">
		</div>
	</div>
	<div class="modal-footer">
		<div class="row form-group">
			<input type="submit" class="btn btn-primary" value="Submit">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>