<form action="/updateVehicle" method="post">

	{{ csrf_field() }}

	<div class="row form-group">
		<div class="col-lg-4">
			<label>Vehicle Number</label>
		</div>
		<input type="hidden" name="id" value="{{$vehicle->id}}">
		<div class="col-lg-8">
			<input type="text" name="vehicle_registation_number" class="form-control" value="{{$vehicle->vehicle_registation_number}}" required="true">
		</div>
	</div>
	<div class="modal-footer">
		<div class="row form-group">
			<input type="submit" class="btn btn-primary" value="Submit">         
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>