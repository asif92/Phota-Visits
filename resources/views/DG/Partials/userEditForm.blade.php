<form action="/updateUser" method="post">
	{{ csrf_field() }}
	@if(isset($user))
		<input type="hidden" name="user_id" class="form-control" value="{{$user->id}}">
	@endif
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Username</label>    				
		</div>
		<div class="col-lg-8">
			<input type="text" name="name" class="form-control alphaNumeric inputText" value="{{$user->name}}" required="true" title="white space are not allowed." maxlength="15" minlength="3">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Email</label>    				
		</div>
		<div class="col-lg-8">
			<input type="email" name="email" class="form-control" value="{{$user->email}}" required="true" title="Enter proper email pattern">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Select User Type</label>
		</div>
		<div class="col-lg-8">
			{!!Form::select('user_type', config('phota.APP_USERTYPE'), $user->user_type, ['class' => 'form-control'])!!}
		</div>
	</div>
	<div class="modal-footer">
		<div class="row form-group">
			<input type="submit" class="btn btn-primary" value="Submit">            
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>
