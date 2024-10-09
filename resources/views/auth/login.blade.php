<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/AdminLTE.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/_all-skins.css')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row" style="margin-top: 1%;">
                <div class="col-md-1 col-lg-1 login_header_image">
                    <img src="{{asset('images/PHOTA.jpg')}}" class="loginImage">
                </div>
                <div class="col-md-10 col-lg-10">
                    <h3 class="text-center text-primary">
                        Punjab Human Organ Transplant Authority
                    </h3>
                    <h4 class="text-center">
                        <img src="{{asset('images/meeting.png')}}" style="width: 40px; height: 30px;">
                        Meeting Information System (MIS)
                    </h4>
                </div>
                <div class="col-md-1 col-lg-1 login_header_image">
                    <img src="{{asset('images/govlogo.png')}}" class="loginImage">
                </div>
            </div>
            <div class="row">
                <div class=" col-md-offset-1 col-md-8 col-md-offset-1 login_container">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #3c8dbc; color: #fff;">Login</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{asset('js/adminlte.js')}}"></script>
</html>







