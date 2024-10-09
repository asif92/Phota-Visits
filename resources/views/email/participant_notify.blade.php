<!DOCTYPE html>
<html>
<head>
	<title>This is the email.</title>
</head>
<body>
	<h1>Dear <strong>{{  $participant_detail->participant_name }} </strong></h1>
	<p>Your meeitng with <strong> {{ $event_detail->inviting_official }} </strong>has been confirmed on <strong>  {{$event_detail->event_date}} </strong> at <strong> {{$event_detail->event_time}} </strong></p>
</body>
</html>