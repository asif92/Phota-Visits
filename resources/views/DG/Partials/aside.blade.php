@if(Auth::guest())
@else
<!-- <aside class="main-sidebar"> -->
<!-- sidebar: style can be found in sidebar.less -->
<!-- <section class="sidebar"> -->
<!-- Sidebar user panel -->
<!--     <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('images/admin.png')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin User</p>
      </div>
    </div> -->
    <!-- search form -->
<!--     <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
<!--     <ul class="sidebar-menu">
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

    </ul>
  </section>
-->  <!-- /.sidebar -->
<!-- </aside> -->
@endif
