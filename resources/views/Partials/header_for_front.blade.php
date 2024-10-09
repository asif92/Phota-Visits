<header class="main-header">
	<a href="#" class="logo">
		<span class="logo-mini">Phota</span>
		<span class="logo-lg">
			<img src="{{asset('images/PHOTA.jpg')}}" class="img-responsive">
		</span>
	</a>
	<nav class="navbar navbar-static-top">
		<h4 class="sidebar-toggle dept_name text-center">
			Punjab Human Organ Transplantation Authority
			<sub class="app_name"><img src="{{asset('images/meeting.png')}}" style="width: 40px; height: 30px;">Meeting Information System (MIS)</sub>
		</h4>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				@if (Auth::guest())
				<li><a href="{{ route('login') }}">Login</a></li>
				<li><a href="{{ route('register') }}">Register</a></li>
				@else
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{asset('images/admin.png')}}" class="user-image" alt="User Image">
						<span class="hidden-xs">{{ Auth::user()->name }}<span class="caret"></span></span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="{{asset('images/admin.png')}}" class="img-circle" alt="User Image">
							<p>
								{{ Auth::user()->name }}
							</p>
						</li>
						<li class="user-footer">
							<div class="text-center">
								<a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									Logout
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</div>
						</li>
					</ul>
				</li>
				@endif
			</ul>
		</div>
	</nav>
</header>