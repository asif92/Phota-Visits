<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Phota Visits</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/AdminLTE.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/google_map.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/_all-skins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.css')}}">
    <!-- <script type="text/javascript" src="{{asset('js/google_map.js')}}" ></script> -->
    <script type="text/javascript" src="{{asset('js/jquery.js')}}" ></script>
    <!-- <script type="text/javascript" src="{{asset('js/jquery-ui.js')}}" ></script> -->
    <script type="text/javascript" src="{{asset('js/meeting_form.js')}}" ></script>

    @yield('custom_style')
    <style type="text/css">
    .gop_logo
    {
        top: 75px;
        right: 0;
        position: fixed;
        height: 100px;
    }
    .firstlist a span
    {
        color: #fff;
    }
    .skin-blue .main-header .navbar .sidebar-toggle:hover
    {
        background-color: transparent;
    }
    @media (max-width: 767px)
    {
        .menu_bar{
            margin-top: 20px;
        }
    }
    @media (max-width: 623px)
    {
        .menu_bar{
            margin-top: 50px;
        }
    }
    @media (max-width: 574px)
    {
        .menu_bar{
            margin-top: 75px;
        }
    }
    @media (max-width: 907px)
    {
        .main-header .logo
        {
            height: 82px !important;
        }
    }
    @media (max-width: 903px)
    {
        #bs-example-navbar-collapse-1 .navbar-nav
        {
            margin-left: 12% !important;
        }
    }
    @media (max-width: 789px)
    {
        #bs-example-navbar-collapse-1 .navbar-nav
        {
            margin-top: -6% !important;
        }
        .menu_bar
        {
            margin-top: 6px;
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
    @media (max-width: 767px)
    {
        .menu_bar{
            margin-top: 64px;
        }
    }
    @media (max-width: 677px)
    {
        .menu_bar{
            margin-top: 90px;
        }
    }


    @media (max-width: 559px)
    {
        .menu_bar{
            margin-top: 115px;
        }
    }
    @media (max-width: 370px)
    {
        .menu_bar{
            margin-top: 140px;
        }
    }
    @media (max-width: 357px)
    {
        .menu_bar{
            margin-top: 165px;
        }
    }
    @media (max-width: 312px)
    {
        .menu_bar{
            margin-top: 190px;
        }
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
  }

  .switch input {display:none;}

  .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
  }

  .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
  }

  input:checked + .slider {
      background-color: #2196F3;
  }

  input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
      border-radius: 34px;
  }

  .slider.round:before {
      border-radius: 50%;
  }



  #external-events h4 {
    font-size: 16px;
    margin-top: 0;
    padding-top: 1em;
}
#wrap{
    height: 600px;
}
#calendar {
    width: auto;
    height: 600px;
}
.eventClass
{
    text-align: center;
    border: none;
    padding: 2px;
    cursor: pointer;
}




</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">




    <div id="app" >
        @if (Auth::guest())
        @else
        @include('Partials.header')
        @endif
        <div class="row">
            @include('Partials.aside')
        </div>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- <div class="control-sidebar-bg"></div> -->



    <div id="add_new_participant" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center modal_heading">Add Participant</h4>
                </div>
                <div class="modal-body">
                    @include('Partials.participantForm')
                </div>
            </div>
        </div>
    </div>

    <div id="add_new_user" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center modal_heading">Add User</h4>
                </div>
                <div class="modal-body">
                    @include('Partials.newUserForm')
                </div>
            </div>
        </div>
    </div>

    <div id="add_new_vehicle" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center modal_heading">Add Vehicle</h4>
                </div>
                <div class="modal-body">
                    @include('Partials.newVehicleForm')
                </div>
            </div>
        </div>
    </div>



    <!-- Scripts -->
    <!-- <script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script> -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="http://www.datejs.com/build/date.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-timepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-ui-1.10.2.custom.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/adminlte.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/fullcalendar.js')}}"></script>
    <!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> -->

    @yield('custom_script')

    <script type="text/javascript">
        // jQuery(function($){
        //     $(".contact").mask("(99999) 9999999");
        // });
        // jQuery(function($){
        //     $(".vehicle").mask("aaa-9999");
        // });
        function alpha(e) {
         var k;
         document.all ? k = e.keyCode : k = e.which;
         return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8);
     }

     var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        specialKeys.push(9); //Tab
        specialKeys.push(46); //Delete
        specialKeys.push(36); //Home
        specialKeys.push(35); //End
        specialKeys.push(37); //Left
        specialKeys.push(39); //Right
        // specialKeys.push(95); //Undersore
        // specialKeys.push(45); //Undersore
        // specialKeys.push(189); //Undersore
        function IsAlphaNumericfirst(e) {
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            document.getElementById("first").style.display = ret ? "none" : "inline";
            return ret;
        }

        function IsAlphaNumericmiddle(e) {
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            document.getElementById("middle").style.display = ret ? "none" : "inline";
            return ret;
        }

        function IsAlphaNumericlast(e) {
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            document.getElementById("last").style.display = ret ? "none" : "inline";
            return ret;
        }

        function IsAlphaNumericusername(e) {
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            document.getElementById("usernameerror").style.display = ret ? "none" : "inline";
            return ret;
        }

        $(function() {
            $('.alphaNumeric').on('keypress', function(e) {
                if (e.which == 32)
                    return false;
            });
        });

        // onkeypress="return alpha(event)"
        // function validate(evt) {
        //         var theEvent = evt || window.event;
        //         var key = theEvent.keyCode || theEvent.which;
        //         key = String.fromCharCode( key );
        //         var regex = /[0-9]|\./;
        //         if( !regex.test(key) ) {
        //         theEvent.returnValue = false;
        //         if(theEvent.preventDefault) theEvent.preventDefault();
        //     }
        // }
        $(document).ready(function() {
            $('.inputText').on('keypress', function (event) {
                var regex = new RegExp("^[a-z A-Z0-9]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                   event.preventDefault();
                   return false;
               }
           });

            $(".inputTextBox").keypress(function(event){
                var inputValue = event.which;
                // allow letters and whitespaces only.
                if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('ul li .firstlist'). click(function(){
                $('li .firstlist').removeClass("active");
                $(this).addClass("active");
            })
            $(".sidebar-menu li").on("click", function() {
                $(".nav li").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var allEvents=[];
            var eventId;
            $.ajax({
                url: 'calendarjson',
                dataType: 'JSON',
                success: function (data) {
                    for (var i = 0; i < data.length;  i++)
                    {
                        var dateTime = new Date(data[i].event_date);
                        dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");
                            // var date = new Date(data[i].event_date);
                            // var date_1 = $.datepicker.formatDate('yy-mm-dd HH:mm:ss', date);
                            if ( data[i].event_type_id==1)
                            {
                                allEvents.push({
                                    "start": dateTime,
                                    "title": data[i].event_title,
                                    "backgroundColor": data[i].event_type.event_type_color,
                                    "url": '/eventDetail/'+ data[i].id,
                                    "className": 'eventClass'
                                });
                            }
                            else if  ( data[i].event_type_id==2)
                            {
                                allEvents.push({
                                    "start": dateTime,
                                    "title": data[i].event_title,
                                    "backgroundColor": data[i].event_type.event_type_color,
                                    "url": '/eventDetail/'+ data[i].id,
                                    "className": 'eventClass'
                                });
                            }
                            else
                            {
                                allEvents.push({
                                    "start": dateTime,
                                    "title": data[i].event_title,
                                    "backgroundColor": data[i].event_type.event_type_color,
                                    "url": '/eventDetail/'+ data[i].id,
                                    "className": 'eventClass'
                                });
                            }
                            // alert(JSON.stringify(dateTime));
                        }
                    // alert(JSON.stringify(allEvents));
                    // alert(JSON.stringify(eventId));
                    $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        // defaultDate: '2014-06-12',
                        editable: false,
                        events: allEvents,
                        disableDragging: true,
                    });
                }
            });
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCM9Jlbs6HagK636JDchLW6dEx9aZj_lzs&callback=initMap"></script>
    <script type="text/javascript" src="{{asset('js/google_map.js')}}"></script>
</body>
</html>
