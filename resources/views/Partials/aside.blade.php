@if(Auth::guest())
@else
<!-- <nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff;">Meetings <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{URL::to('meeting/today')}}"><i class="fa fa-circle-o"></i>Meetings</a>
						</li>
						<li>
							<a href="{{URL::to('/outgoing')}}"><i class="fa fa-circle-o"></i>Outgoing Meetings</a>
						</li>
					</ul>
				</li>
				<li class="firstlist">
					<a href="{{URL::to('private_meeting/today')}}">
						<i class="glyphicon glyphicon-lock"></i> <span>Private Meeting</span>
					</a>
				</li>

				<li class="firstlist">
					<a href="{{URL::to('visit/today')}}">
						<i class="fa fa-users"></i> <span>Visit</span>
					</a>
				</li>

				<li class="firstlist">
					<a href="{{URL::to('users')}}">
						<i class="fa fa-users"></i> <span>Users</span>
					</a>
				</li>
				<li class="firstlist">
					<a href="{{URL::to('calendar')}}" >
						<i class="fa fa-calendar"></i> <span>Calendar</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
 --><!-- <aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">ADMINISTRATOR</li>
      <li class="active treeview firstlist">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Meetings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-down pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{URL::to('meeting/today')}}"><i class="fa fa-circle-o"></i>Meetings</a>
          </li>
          <li>
            <a href="{{URL::to('/outgoing')}}"><i class="fa fa-circle-o"></i>Outgoing Meetings</a>
          </li>
        </ul>
      </li>
      <li class="firstlist">
        <a href="{{URL::to('private_meeting/today')}}">
          <i class="glyphicon glyphicon-lock"></i> <span>Private Meeting</span>
        </a>
      </li>

      <li class="firstlist">
        <a href="{{URL::to('visit/today')}}">
          <i class="fa fa-users"></i> <span>Visit</span>
        </a>
      </li>

      <li class="firstlist">
        <a href="{{URL::to('users')}}">
          <i class="fa fa-users"></i> <span>Users</span>
        </a>
      </li>
      <li class="firstlist">
        <a href="{{URL::to('calendar')}}" >
          <i class="fa fa-calendar"></i> <span>Calendar</span>
        </a>
      </li>
    </ul>
  </section>
</aside> -->
@endif
