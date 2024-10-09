<form action="/users" method="post">
	{{ csrf_field() }}
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Username</label>
		</div>
		<div class="col-lg-8">
			<input type="text" name="name" class="form-control alphaNumeric inputText" required="true" title="white space are not allowed." maxlength="15" minlength="3">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Email</label>
		</div>
		<div class="col-lg-8">
			<input type="email" name="email" class="form-control" required="true" title="Enter proper email pattern">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Password</label>
		</div>
        <div class="col-lg-8">
			<input type="password" name="password" class="form-control" required="true">
        </div>
	</div>
	<div class="row form-group">
		<div class="col-lg-4">
			<label>Select User Type</label>
		</div>
		<div class="col-lg-8">
			{!!Form::select('user_type', config('phota.APP_USERTYPE'), null, ['class' => 'form-control'])!!}
		</div>
	</div>
	<div class="modal-footer">
		<div class="row form-group">
			<input type="submit" class="btn btn-primary" value="Submit">            
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>
