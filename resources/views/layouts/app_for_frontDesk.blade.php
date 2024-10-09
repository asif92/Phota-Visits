<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>PHOTA</title>
	<script src="{{ asset('js/app.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/ionicons.min.css')}}">


	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('css/AdminLTE.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/_all-skins.css')}}">



	<style type="text/css">


	body,h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6{
		font-family: sans-serif;
	}

	ul,li{
		list-style-type: none;
	}
	.main-col::after{
		content: '';
		position: absolute;
		left: 100%;
		top: 30%;
		width: 0;
		height: 0;
		border-top: 20px solid transparent;
		border-bottom: 20px solid transparent;
		border-left: 20px solid #3c8dbc;
		clear: both;
	}
	.add-arrow:hover{
		background-color: #d9dbdc;
		color: #000;
	}

	.add-arrow:focus{
		background-color: #3c8dbc;
	}
	.firstclass{
		border: solid 1px #3c8dbc;
	}
	.secondclass{
		background-color: #3c8dbc;
		/*color: white;*/
	}
	.col-lg-8>h4{
		margin-top:4%
	}
	::-webkit-scrollbar {
		width: 5px;
	}

	::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		border-radius: 10px;
	}

	::-webkit-scrollbar-thumb {
		border-radius: 10px;
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
	}
	.tab-content{
		border: solid 1px #3c8dbc;
		padding: 5% 4%;
	}
		/*input[type=checkbox] {
			height: 0;
			width: 0;
			visibility: hidden;
			}*/

			td > label {
				cursor: pointer;
				text-indent: -9999px;
				width: 70px;
				height: 30px;
				background: grey;
				display: block;
				border-radius: 100px;
				position: relative;
			}

			td >label:after {
				content: '';
				position: absolute;
				top: 5px;
				left: 5px;
				width: 20px;
				height: 20px;
				background: #fff;
				border-radius: 90px;
				transition: 0.3s;
			}

			input:checked + label {
				background: #bada55;
			}

			input:checked + label:after {
				left: calc(100% - 5px);
				transform: translateX(-100%);
			}

			td >label:active:after {
				width: 130px;
			}
			.skin-blue .main-header .navbar .sidebar-toggle:hover
			{
				background-color: transparent;
			}
			/*  */
			@media (max-width: 1196px)
			{
				.dept_name
				{
					margin-left: 0%;
				}
			}
			@media (max-width: 1148px)
			{
				.dept_name
				{
					margin-left: 0%;
					width: 80%;
				}
				.navbar-custom-menu
				{
					font-size: smaller;
				}
			}
			@media (max-width: 1080px)
			{
				.dept_name
				{
					padding: 0px !important;
				}
			}

			@media (max-width: 903px)
			{
				#bs-example-navbar-collapse-1 .navbar-nav
				{
					margin-left: 12% !important;
				}
			}
			@media (max-width: 869px)
			{
				.main-header .logo
				{
					height: 108px !important;
				}
				.container
				{
					margin-top: 10px;
				}
				.logo .logo-lg
				{
					margin-top: 19px;
				}
			}
			@media (max-width: 853px)
			{
				.app_name
				{
					margin-left: -80%;
				}
			}
			@media (max-width: 853px)
			{
				.dept_name
				{
					font-size: large;
					width: 65%;
				}
			}
			@media (max-width: 789px)
			{
				.dept_name
				{
					font-size: medium;
					width: 60%;
				}
			}
			@media (max-width: 789px)
			{
				#bs-example-navbar-collapse-1 .navbar-nav
				{
					margin-top: -6% !important;
				}
				.main-header .logo
				{
					height: 108px !important;
				}
				.logo .logo-lg
				{
					margin-top: 19px;
				}
			}
			@media(max-width: 767px)
			{
				.gatekeeper_top_heading
				{
					margin-top: 11%;
				}
				.dept_name
				{
					font-size: large;
					width: 52%;
					margin-left: 14%;
				}
				.container
				{
					margin-top: 85px;
				}
			}
			@media(max-width: 682px)
			{
				.dept_name
				{
					width: 60%;
				}
				.gatekeeper_top_heading
				{
					margin-top: 13%;
				}
			}
			@media(max-width: 592px)
			{
				.dept_name
				{
					width: 65%;
				}
				.gatekeeper_top_heading
				{
					margin-top: 16%;
				}
			}
			@media(max-width: 547px)
			{
				.dept_name
				{
					width: 75%;
					margin-left: 0%;
				}
			}
			@media(max-width: 474px)
			{
				.dept_name
				{
					width: 80%;
				}
				.gatekeeper_top_heading
				{
					margin-top: 20%;
				}
			}
			@media(max-width: 445px)
			{
				.dept_name
				{
					width: 85%;
				}
			}
			@media(max-width: 419px)
			{
				.dept_name
				{
					font-size: inherit;
					margin-left: -7%;
					margin-top: 0%;
				}
				.dept_name .app_name
				{
					margin-left: -70%;
				}
			}
			@media(max-width: 380px)
			{
				.dept_name
				{
					font-size: small;
				}
				.gatekeeper_top_heading
				{
					margin-top: 23%;
				}
			}
			@media(max-width: 345px)
			{
				.dept_name
				{
					margin-left: -2%;
				}
				.dept_name .app_name
				{
					margin-left: -80%;
				}
				.gatekeeper_top_heading
				{
					margin-top: 26%;
				}
			}

		</style>
	</head>
	<body class="hold-transition skin-blue sidebar-mini" >
		@include('Partials.header_for_front')

		@yield('content')
		{{-- <script src="{{ asset('js/app.js') }}"></script> --}}



		<script type="text/javascript" src="{{asset('js/adminlte.js')}}"></script>
		<script type="text/javascript">

			$(document).ready(function(){
				var array = $( "ul li .add-arrow" ).toArray();
				$(array[0]).addClass("main-col");
				var array = $( "ul li .firstclass" ).toArray();
				$(array[0]).addClass("secondclass");
				var array = $( ".meeting_attendees" ).toArray();
				$(array[0]).addClass("active");


		// $('ul li .add-arrow[0]').addClass('main-arrow')
		$('ul li .add-arrow'). click(function(){
			$('li .add-arrow').removeClass("main-col");
			$(this).addClass("main-col");
			// $('.main-col').addClass("ad-arrow");
		});

		$('ul li .firstclass'). click(function(){
			$('li .firstclass').removeClass("secondclass");
			$(this).addClass("secondclass");
			// $('.main-col').addClass("ad-arrow");
		});

		$(document).ready(function(){
			$(document).on('click', '.sidebar-menu li ', function () {
				console.log($(this));
				$('li .active').removeClass('active');
				$(this).addClass('active');
			});
		});
	});
</script>
</body>
</html>