@extends('layouts.app')


@section('content')

<div class="row">
	<div class="col-sm-2"> </div>
	<div class="col-sm-8">
		<h1 class="text-center main_heading">
			All Users
		</h1>
		<button class="btn btn-primary" data-toggle="modal" data-target="#add_new_user">Add New User</button>
		<div class="table-responsive">
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Sr #</th>
						<th>Username</th>
						<th>User Type</th>
						<th></th>
					</tr>
				</thead>
				<tbody>


					@foreach ($users as $index => $user)
					<tr>
						<td>{{$index+1}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->user_type}}</td>
						@if(Auth::User() != $user)
						<td class="text-center">
							<button class="btn btn-xs btn-success" onclick="showUserEditModal('#edit_user',{{$user->id}})">
								Edit
							</button>
							<button class="btn btn-xs btn-danger">
								<a href="/deleteUser/{{$user->id}}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
							</button>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
	<div class="col-sm-2"> </div>

</div>

<div class="text-center">
	{!! $users->links() !!}
</div>


<div id="edit_user" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Edit User</h4>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>

<div id="delete_user" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Edit User</h4>
			</div>
			<div class="modal-body">
				<p>
					Are you sure want to delete?
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default">Yes</button>
				<button type="button" class="btn btn-default">No</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>

	@endsection






	@section('custom_script')

	<script type="text/javascript">

		function showUserEditModal(modal_id,id) {
			$.get('/showUser/'+id,function(data){
				var element = "<div class= 'modal_data_div'></div>";
				$('.modal_data_div').remove();
				$(modal_id).find('.modal-body').append(element);
				$('.modal_data_div').append(data);
				$(modal_id).modal('show')
			});
		}



	</script>

	@endsection