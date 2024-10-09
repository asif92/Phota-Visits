<header class="main-header">
	<span href="#" class="logo">
		<span class="logo-mini">Phota</span>
		<span class="logo-lg">
			<img src="{{asset('images/PHOTA.jpg')}}" class="img-responsive">
		</span>
	</span>
	<nav class="navbar">
		<h4 class="sidebar-toggle dept_name text-center" style="width: 70%; margin-top: 0px;">
			Punjab Human Organ Transplant Authority
			<br/>
			<span>
				<img src="{{asset('images/meeting.png')}}" style="width: 40px; height: 30px;">Meeting Information System (MIS)
			</span>
		</h4>
		<div class="navbar-custom-menu" style="padding: 0px;">
			<ul class="nav navbar-nav">
				@if (Auth::guest())
				<li><a href="{{ route('login') }}">Login</a></li>
				<li><a href="{{ route('register') }}">Register</a></li>
				@else
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{asset('images/admin.png')}}" class="user-image" alt="User Image">
						<span class="hidden-xs">{{ Auth::user()->name }} <span class="caret"></span></span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="{{asset('images/admin.png')}}" class="img-circle" alt="User Image">
							<p>
								{{ Auth::user()->name }}
							</p>
						</li>
						<li class="user-footer">
							<a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								Logout
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					</ul>
				</li>
				@endif
			</ul>
		</div>
	</nav>
</header>
<nav class="navbar navbar-inverse menu_bar" style="border-radius: 0px;">
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
							<a href="{{URL::to('/superadmin/meeting/all')}}"><i class="fa fa-circle-o"></i>Meetings</a>
						</li>
						<li>
							<a href="{{URL::to('/dgoutgoing')}}"><i class="fa fa-circle-o"></i>Outgoing Meetings</a>
						</li>
					</ul>
				</li>
				<li class="firstlist">
					<a href="{{URL::to('/superadmin/private_meeting/all')}}">
						<i class="glyphicon glyphicon-lock"></i> <span>Private Meeting</span>
					</a>
				</li>

				<li class="firstlist">
					<a href="{{URL::to('/superadmin/visit/all')}}">
						<i class="fa fa-users"></i> <span>Visit</span>
					</a>
				</li>

<!-- 				<li class="firstlist">
					<a href="{{URL::to('users')}}">
						<i class="fa fa-users"></i> <span>Users</span>
					</a>
				</li>
				<li class="firstlist">
					<a href="{{URL::to('calendar')}}" >
						<i class="fa fa-calendar"></i> <span>Calendar</span>
					</a>
				</li> -->

<!-- 				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff;">Export<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li role="presentation">
							<a role="menuitem" href="{{URL::to('exporttoexcel')}}/xls"><i class="fa fa-circle-o"></i>Excel File</a>
						</li>
						<li>
							<a href="{{URL::to('exporttoexcel')}}/csv"><i class="fa fa-circle-o"></i>CSV File</a>
						</li>
					</ul>
				</li> -->
			</ul>
		</div>
	</div>
</nav>

