@extends('DG.layouts.app')


@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="text-center main_heading">
			Outgoing Meetings
		</h1>
	</div>
</div>


<div class="row">
	<div class="table-responsive" >
		<table class="table table-hover table-striped" id="eventTable">
			<thead>
				<tr>
					<th>Sr #</th>
					<th>Meeting Title</th>
					<th>Meeting Agenda</th>
					<th>Meeting Venue</th>
					<th>Meeting Date & Time</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@foreach ($events as $index => $event)
				<tr>
					<td>{{$index+1}}</td>
					<td>{{$event->event_title}}</td>
					<td>{{$event->event_description}}</td>
					<td>{{$event->event_venue}}</td>
					<td>{{$event->event_date}} at {{$event->event_time}}</td>
					<td>
						<button class="btn  btn-success">
							<a href="{{URL::to('superadmin/externalMeetingApproval')}}/{{$event->id}}/1" style="color: #fff;">Approved</a>
						</button>

						<button class="btn btn-danger">
							<a href="{{URL::to('superadmin/externalMeetingApproval')}}/{{$event->id}}/2" style="color: #fff;">Cancel</a>
						</button>

						<button class="btn btn-primary">
							<a href="{{URL::to('superadmin/externalmeetingApproval')}}/{{$event->id}}/3" style="color: #fff;">Postpone</a>
						</button>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>
	</div>
</div>





@endsection



@section('custom_script')

<script type="text/javascript">

    // $( '#datepicker2' ).datepicker({dateFormat : 'dd-MM-yy'});
</script>

@endsection
