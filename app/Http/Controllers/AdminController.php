<?php

namespace App\Http\Controllers;

use App\EventVehicle;
use App\ExtrnalEvents;
use App\HospitalityPackage;
use App\MyEvent;
use App\MyEventParticipant;
use App\Participant;
use App\Status;
use App\User;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller {

	protected $meeting_type = '';
	protected $meeting_type_name = '';
	protected $current_url = '';

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('admin');
		if (\Request::is('meeting/*') || \Request::is('addEvent')) {
			$this->meeting_type = 1;
			$this->current_url = 'meeting';
			$this->meeting_type_name = "Meeting";
		} else if (\Request::is('private_meeting/*') || \Request::is('addEvent')) {
			$this->meeting_type = 2;
			$this->current_url = 'private_meeting';
			$this->meeting_type_name = "Private Meeting";
		} else if (\Request::is('visit/*') || \Request::is('addEvent')) {
			$this->meeting_type = 3;
			$this->current_url = 'visit';
			$this->meeting_type_name = "Visit";
		} else {
			$this->meeting_type = 1;
		}

	}

	public function allUsers() {
		$users = User::paginate(10);
		$event_name = '';
		return view('Pages.Visitor', compact('event_name', 'users'));
	}

	public function storeUser(Request $request) {
		$this->validate($request, [
			'email' => 'required|string|email|max:255|unique:users',
		]);

		$user = new User();
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		$user->user_type = $request->input('user_type');
		$user->save();
		return redirect()->back();
	}

	public function deleteUser($id) {
		$user = User::find($id);
		$user->delete();
		return redirect()->back();
	}

	public function showUser($id) {
		$user = User::find($id);
		return view('Partials.userEditForm', compact('user'));
	}

	public function updateUser(Request $request) {
		$user = User::find($request->input('user_id'));
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->user_type = $request->input('user_type');
		$user->save();
		return redirect()->back();
	}

	public function allEvents($event_type) {

		$current_date = Carbon::today()->format('Y-m-d');

		if (isset($event_type)) {
			$loadEvents = $event_type;
		} else {
			$loadEvents = 'today';
		}

		if ($loadEvents == 'today') {
			$events = MyEvent::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->where('event_type_id', $this->meeting_type)->where('event_date', $current_date)->paginate(10);
		} else if ($loadEvents == 'upcoming') {
			$events = MyEvent::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->where('event_type_id', $this->meeting_type)->where('event_date', '>', $current_date)->paginate(10);
		} else {
			$events = MyEvent::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->where('event_type_id', $this->meeting_type)->paginate(10);
		}

		// $eventStatus = EventStatus::pluck('event_status_name', 'id');

		$event_name = $this->meeting_type_name;
		$event_type_id = $this->meeting_type;
		$current_URL = $this->current_url;
		$selected_event_type = $loadEvents;

		return view('Pages.Dashboard', compact('events', /*'eventStatus',*/'event_name', 'event_type_id', 'current_URL', 'selected_event_type'));

	}

	// public function specificEvents($event_type)
	// {
	// 	// return $event_type;
	// 	$events = MyEvent::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->where('event_type_id',1)->paginate(2);

	// 	return $events;
	// }

	public function showEvent($id) {
		$event = MyEvent::find($id);
		$status = Status::pluck('status_name', 'id');
		$event_name = $this->meeting_type_name;

		if ($event->event_type_id == 3) {
			$event_name = 'Visit';
		} else {
			$event_name = 'Others';
		}
		// $event->

		return view('Pages.Staff', compact('event', 'status', 'event_name'));
	}

	public function storeParticipant(Request $request) {
		$participant = new Participant();
		$participant->participant_name = $request->input('participant_name');
		$participant->participant_department = $request->input('participant_department');
		$participant->participant_designation = $request->input('participant_designation');
		$participant->participant_email = $request->input('participant_email');
		$participant->participant_contact = $request->input('participant_contact');
		$participant->save();

		$eParticipant = new MyEventParticipant();
		$eParticipant->my_event_id = $request->input('event_id');
		$eParticipant->participant_id = $participant->id;
		$eParticipant->status_id = $request->input('status_id');
		$eParticipant->save();

		return redirect()->back();
	}

	public function storeVehicle(Request $request) {
		$vehicle = new Vehicle();
		$vehicle->vehicle_registation_number = $request->input('vehicle_registation_number');
		$vehicle->save();
		$event_vehicle = new EventVehicle();
		$event_vehicle->vehicle_id = $vehicle->id;
		$event = MyEvent::find($request->input('event_id'));
		$event->eventVehicles()->save($event_vehicle);
		return redirect()->back();
	}

	public function showVehicle($id) {
		$vehicle = Vehicle::find($id);
		return view('Partials.vehicleEditForm', compact('vehicle'));
	}

	public function updateVehicle(Request $request) {
		$vehicle = Vehicle::find($request->input('id'));
		$vehicle->vehicle_registation_number = $request->input('vehicle_registation_number');
		$vehicle->save();
		return redirect()->back();
	}

	public function deleteVehicle($id, $event_id) {
		$event = EventVehicle::where('vehicle_id', $id)->where('vehicleable_id', $event_id)->where('vehicleable_type', 'App\\MyEvent')->first();
		$event->delete();
		// $vehicle = Vehicle::find($id);
		// $vehicle->delete();

		return redirect()->back();
	}

	public function showParticipant($id, $event_id) {
		$participant = Participant::with(['MyEventParticipants' => function ($query) use ($event_id, $id) {
			$query->where('my_event_id', $event_id);
			$query->where('participant_id', $id);
		}])->find($id);

		$part_status = $participant->MyEventParticipants[0];

		$status = Status::pluck('status_name', 'id');

		$event = MyEvent::find($event_id);
		$event_type_name = $event->eventType->event_type_name;
		if ($event_type_name == 'meeting') {
			$event_name = 'Meeting';
		} else if ($event_type_name == 'private_meeting') {
			$event_name = 'Private Meeting';
		} else {
			$event_name = 'Visit';

		}

		return view('Partials.participantEditForm', compact('participant', 'status', 'part_status', 'event_name'));
	}

	public function updateParticipant(Request $request) {
		$participant = Participant::find($request->input('id'));
		$participant->participant_name = $request->input('participant_name');
		$participant->participant_department = $request->input('participant_department');
		$participant->participant_designation = $request->input('participant_designation');
		$participant->participant_email = $request->input('participant_email');
		$participant->participant_contact = $request->input('participant_contact');
		$participant->save();

		$eParticipant = MyEventParticipant::find($request->input('event_part_id'));
		$eParticipant->status_id = $request->input('status_id');
		$eParticipant->save();

		return redirect()->back();
	}

	public function deleteParticipant($id, $event_id) {
		$event = MyEventParticipant::where('my_event_id', $event_id)->where('participant_id', $id)->first();
		$event->delete();
		return redirect()->back();
	}

	public function storeEvent(Request $request) {
		$meeting = "true";
		$colon = ":";
		$events = MyEvent::all();
		foreach ($events as $event) {
			$date = date_create($event->event_date);
			$event_time[] = date("G:i", strtotime($event->event_time));
			$event_date[] = date_format($date, "Y/m/d");
			$event_span[] = $event->time_span;
		}

		$date = date_create($request->input('event_date'));
		$input_date_format = date_format($date, "Y/m/d");

		for ($i = 0; $i < count($event_time); $i++) {
			$event_time_separtor[] = explode(':', $event_time[$i]);

		}

		for ($i = 0; $i < count($event_time_separtor); $i++) {
			$event_minutes_time_start[] = $event_time_separtor[$i][0] * 60 + $event_time_separtor[$i][1];

		}

		for ($i = 0; $i < count($event_minutes_time_start); $i++) {

			$event_minutes_time_end[] = $event_minutes_time_start[$i] + $event_span[$i];

		}

		$input_event_time = date("G:i", strtotime($request->input('event_time')));
		$time_separtor = explode(':', $input_event_time);
		$time_separtor[0]; //hour
		$time_separtor[1]; //minutes_status
		$time_status_separator = explode(' ', $time_separtor[1]);
		// $time_status = $time_status_separator[1]; //Am or Pm

		$get_form_time = $time_separtor[0] * 60 + $time_separtor[1];
		$get_span_form_time = $get_form_time + $request->input('time_span');

		for ($i = 0; $i < count($event_minutes_time_start); $i++) {

			if ($get_form_time > $event_minutes_time_start[$i] && $get_form_time < $event_minutes_time_end[$i] && $input_date_format == $event_date[$i]) {
				$meeting = "false";

			}

			if ($get_form_time < $event_minutes_time_start[$i] && $get_span_form_time > $event_minutes_time_start[$i] && $input_date_format == $event_date[$i]) {

				$meeting = "false";

			}

			if ($get_form_time < $event_minutes_time_start[$i] && $get_span_form_time > $event_minutes_time_end[$i] && $input_date_format == $event_date[$i]) {

				$meeting = "false";

			}

			if (($get_form_time == $event_minutes_time_start[$i] || $get_span_form_time == $event_minutes_time_end[$i]) && $input_date_format == $event_date[$i]) {

				$meeting = "false";

			}

		}

		if ($meeting == "false") {
			return "no slot";
		} else {
			if ($request->input('hospitality_check') == 'on') {
				$check_hospitality = 1;
				$hospitality_package_id = $request->input('hospitality_package_id');
			} else {
				$check_hospitality = 0;
				$hospitality_package_id = null;
			}

			$event = new MyEvent();
			$event->event_type_id = $request->input('event_type_id');
			$event->event_title = $request->input('event_title');
			$event->hospitality_allowed = $check_hospitality;
			$event->event_description = $request->input('event_description');
			$event->event_venue = $request->input('event_venue');
			$event->event_remarks = $request->input('event_remarks');

			$event->event_date = $request->input('event_date');
			$event->event_time = $request->input('event_time');
			$event->time_span = $request->input('time_span');
			$event->event_status_id = 1;

			if (isset($hospitality_package_id)) {
				$event->hospitality_package_id = $hospitality_package_id;
			} else {
				$event->hospitality_package_id = $hospitality_package_id;
			}

			$event->save();

			return "slot aloted";
		}

		//    return redirect('eventDetail/'.$event->id);
	}
	// public function storeEvent(Request $request) {
	// 	$meeting = "true";
	// 	$colon = ":";
	// 	$events = MyEvent::all();
	// 	foreach ($events as $event) {
	// 		$date = date_create($event->event_date);
	// 		$event_time[] = date("G:i", strtotime($event->event_time));
	// 		$event_date[] = date_format($date, "Y/m/d");
	// 		$event_span[] = $event->time_span;
	// 	}

	// 	$date = date_create($request->input('event_date'));
	// 	$input_date_format = date_format($date, "Y/m/d");

	// 	for ($i = 0; $i < count($event_time); $i++) {
	// 		$event_time_separtor[] = explode(':', $event_time[$i]);

	// 	}

	// 	for ($i = 0; $i < count($event_time_separtor); $i++) {
	// 		$event_minutes_time_start[] = $event_time_separtor[$i][0] * 60 + $event_time_separtor[$i][1];

	// 	}

	// 	for ($i = 0; $i < count($event_minutes_time_start); $i++) {

	// 		$event_minutes_time_end[] = $event_minutes_time_start[$i] + $event_span[$i];

	// 	}

	// 	$input_event_time = date("G:i", strtotime($request->input('event_time')));
	// 	$time_separtor = explode(':', $input_event_time);
	// 	$time_separtor[0]; //hour
	// 	$time_separtor[1]; //minutes_status
	// 	$time_status_separator = explode(' ', $time_separtor[1]);
	// 	// $time_status = $time_status_separator[1]; //Am or Pm

	// 	$get_form_time = $time_separtor[0] * 60 + $time_separtor[1];
	// 	$get_span_form_time = $get_form_time + $request->input('time_span');

	// 	for ($i = 0; $i < count($event_minutes_time_start); $i++) {

	// 		if ($get_form_time > $event_minutes_time_start[$i] && $get_form_time < $event_minutes_time_end[$i] && $input_date_format == $event_date[$i]) {
	// 			$meeting = "false";

	// 		}

	// 		if ($get_form_time < $event_minutes_time_start[$i] && $get_span_form_time > $event_minutes_time_start[$i]) {

	// 			$meeting = "false";

	// 		}

	// 		if ($get_form_time < $event_minutes_time_start[$i] && $get_span_form_time > $event_minutes_time_end[$i]) {

	// 			$meeting = "false";

	// 		}

	// 	}

	// 	if ($meeting == "false") {
	// 		return "no slot";
	// 	} else {
	// 		if ($request->input('hospitality_check') == 'on') {
	// 			$check_hospitality = 1;
	// 			$hospitality_package_id = $request->input('hospitality_package_id');
	// 		} else {
	// 			$check_hospitality = 0;
	// 			$hospitality_package_id = null;
	// 		}

	// 		$event = new MyEvent();
	// 		$event->event_type_id = $request->input('event_type_id');
	// 		$event->event_title = $request->input('event_title');
	// 		$event->hospitality_allowed = $check_hospitality;
	// 		$event->event_description = $request->input('event_description');
	// 		$event->event_venue = $request->input('event_venue');
	// 		$event->event_remarks = $request->input('event_remarks');

	// 		$event->event_date = $request->input('event_date');
	// 		$event->event_time = $request->input('event_time');
	// 		$event->time_span = $request->input('time_span');
	// 		$event->event_status_id = 1;

	// 		if (isset($hospitality_package_id)) {
	// 			$event->hospitality_package_id = $hospitality_package_id;
	// 		} else {
	// 			$event->hospitality_package_id = $hospitality_package_id;
	// 		}

	// 		$event->save();

	// 		return "slot aloted";
	// 	}

	// 	//	return redirect('eventDetail/'.$event->id);
	// }

	public function editEvent($id) {
		$event = MyEvent::find($id);
		$event_type_name = $event->eventType->event_type_name;
		if ($event_type_name == 'meeting') {
			$event_name = 'Meeting';
		} else if ($event_type_name == 'private_meeting') {
			$event_name = 'Private Meeting';
		} else {
			$event_name = 'Visit';

		}

		// $eventStatus = EventStatus::pluck('event_status_name', 'id');
		$hospitality_pack = HospitalityPackage::pluck('package_item_menu', 'id');

		return view('Partials.meetingEditForm', compact('event', /*'eventStatus',*/'hospitality_pack', 'event_name'));

	}

	public function updateEvent(Request $request) {
		$meeting = "true";
		$colon = ":";
		$events = MyEvent::all();
		foreach ($events as $event) {
			if ($event->id != $request->input('event_id')) {
				$date = date_create($event->event_date);
				$event_time[] = date("G:i", strtotime($event->event_time));
				$event_date[] = date_format($date, "Y/m/d");
				$event_span[] = $event->time_span;
			}
		}

		$date = date_create($request->input('event_date'));
		$input_date_format = date_format($date, "Y/m/d");

		for ($i = 0; $i < count($event_time); $i++) {
			$event_time_separtor[] = explode(':', $event_time[$i]);

		}

		for ($i = 0; $i < count($event_time_separtor); $i++) {
			$event_minutes_time_start[] = $event_time_separtor[$i][0] * 60 + $event_time_separtor[$i][1];

		}

		for ($i = 0; $i < count($event_minutes_time_start); $i++) {

			$event_minutes_time_end[] = $event_minutes_time_start[$i] + $event_span[$i];

		}

		$input_event_time = date("G:i", strtotime($request->input('event_time')));
		$time_separtor = explode(':', $input_event_time);
		$time_separtor[0]; //hour
		$time_separtor[1]; //minutes_status
		$time_status_separator = explode(' ', $time_separtor[1]);
		// $time_status = $time_status_separator[1]; //Am or Pm

		$get_form_time = $time_separtor[0] * 60 + $time_separtor[1];
		$get_span_form_time = $get_form_time + $request->input('time_span');

		for ($i = 0; $i < count($event_minutes_time_start); $i++) {

			if ($get_form_time > $event_minutes_time_start[$i] && $get_form_time < $event_minutes_time_end[$i] && $input_date_format == $event_date[$i]) {
				$meeting = "false";

			}

			if ($get_form_time < $event_minutes_time_start[$i] && $get_span_form_time > $event_minutes_time_start[$i] && $input_date_format == $event_date[$i]) {

				$meeting = "false";

			}

			if ($get_form_time < $event_minutes_time_start[$i] && $get_span_form_time > $event_minutes_time_end[$i] && $input_date_format == $event_date[$i]) {

				$meeting = "false";

			}

			if (($get_form_time == $event_minutes_time_start[$i] || $get_span_form_time == $event_minutes_time_end[$i]) && $input_date_format == $event_date[$i]) {

				$meeting = "false";

			}

		}

		$event = MyEvent::find($request->input('event_id'));
		$date = date_create($event->event_date);
		$old_date = date_format($date, "Y/m/d");
		$old_time = date("G:i", strtotime($event->event_time));
		$old_time_span = $event->time_span;

		$date = date_create($request->input('event_date'));
		$new_date = date_format($date, "Y/m/d");
		$new_time = date("G:i", strtotime($request->input('event_time')));
		if ($old_date == $new_date && $old_time == $new_time && $old_time_span == $request->input('time_span')) {
			$meeting = "true";
		}

		if ($meeting == "false") {
			return "no slot";
		} else {
			if ($request->input('hospitality_check') == 'on') {
				$check_hospitality = 1;
				$hospitality_package_id = $request->input('hospitality_package_id');
			} else {
				$check_hospitality = 0;
				$hospitality_package_id = null;
			}

			$event = MyEvent::find($request->input('event_id'));
			$event->event_type_id = $request->input('event_type_id');
			$event->event_title = $request->input('event_title');
			$event->hospitality_allowed = $check_hospitality;
			$event->event_description = $request->input('event_description');
			$event->event_venue = $request->input('event_venue');
			$event->event_remarks = $request->input('event_remarks');

			$event->event_date = $request->input('event_date');
			$event->event_time = $request->input('event_time');
			$event->time_span = $request->input('time_span');
			$event->event_status_id = 1;

			if (isset($hospitality_package_id)) {
				$event->hospitality_package_id = $hospitality_package_id;
			} else {
				$event->hospitality_package_id = $hospitality_package_id;
			}

			$event->save();

			return "slot aloted";
		}

		// if ($request->input('hospitality_check') == 'on') {
		// 	$check_hospitality = 1;
		// 	$hospitality_package_id = $request->input('hospitality_package_id');
		// } else {
		// 	$check_hospitality = 0;
		// 	$hospitality_package_id = null;
		// }

		// $event = MyEvent::find($request->input('event_id'));
		// $event->event_type_id = $request->input('event_type_id');
		// $event->event_title = $request->input('event_title');
		// $event->hospitality_allowed = $check_hospitality;
		// $event->event_description = $request->input('event_description');
		// $event->event_venue = $request->input('event_venue');
		// $event->event_date = $request->input('event_date');
		// $event->event_remarks = $request->input('event_remarks');
		// $event->event_time = $request->input('event_time');
		// $event->time_span = $request->input('time_span');
		// $event->event_status_id = 1;

		// if (isset($hospitality_package_id)) {
		// 	$event->hospitality_package_id = $hospitality_package_id;
		// } else {
		// 	$event->hospitality_package_id = $hospitality_package_id;
		// }

		// $event->save();
		// return redirect()->back();
	}

	public function hospitalityPackage() {
		return HospitalityPackage::all();
	}

	public function meetingDateTimeCheck(Request $request, $request_type) {
		$date = $request->input('date');
		$time = $request->input('time');
		$time_span = $request->input('time_span');

		$event_date = Carbon::parse($date)->format('Y-m-d');

		$carbon_parsed_new_time = Carbon::parse($time);
		$new_start_time = $carbon_parsed_new_time->format('H:i:s');
		$new_end_time = $carbon_parsed_new_time->addMinutes($time_span)->format('H:i:s');

		$events = MyEvent::where('event_date', $event_date)->get();
		$flag = 0;
		for ($i = 0; $i < count($events); $i++) {

			$carbon_parsed_old_time = Carbon::parse($events[$i]->event_time);
			$old_start_time = $carbon_parsed_old_time->format('H:i:s');
			$old_end_time = $carbon_parsed_old_time->addMinutes($events[$i]->time_span)->format('H:i:s');

			if (($new_start_time > $old_start_time) && (($new_start_time > $old_end_time) || ($new_start_time == $old_end_time))) {
				$flag = 1;
			} else if ($new_start_time == $old_start_time) {
				$flag = 0;
			} else if ($old_start_time < $new_end_time) {
				$flag = 0;
			} else if ($old_start_time > $new_end_time) {
				$flag = 1;
			} else {

			}

		}

		return $flag;
	}
	public function outgoingEvents() {
		$events = ExtrnalEvents::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->paginate(10);
		$event_name = "";
		return view('Pages.outgoing', compact('event_name', 'events'));
	}

	public function deleteExternalEvent($id) {

		$event = ExtrnalEvents::find($id);
		$event->delete();
		return redirect()->back();
	}

	public function storeExternalEvent(Request $request) {

		$event = new ExtrnalEvents();
		$event->event_title = $request->input('event_title');
		$event->event_description = $request->input('event_description');
		$event->event_venue = $request->input('event_venue');
		$event->event_date = $request->input('event_date');
		$event->event_time = $request->input('event_time');
		$event->event_remarks = $request->input('event_remarks');
		$event->save();
		return redirect()->back();
	}

	public function editExternalEvent($id) {

		$event = ExtrnalEvents::find($id);

		return view('Partials.editOutgoingMeetingForm', compact('event'));
	}

	public function updateExternalEvent(Request $request) {

		$event = ExtrnalEvents::find($request->input('event_id'));
		$event->event_title = $request->input('event_title');
		$event->event_description = $request->input('event_description');
		$event->event_venue = $request->input('event_venue');
		$event->event_date = $request->input('event_date');
		$event->event_time = $request->input('event_time');
		$event->event_remarks = $request->input('event_remarks');
		$event->save();
		return redirect()->back();
	}

	public function deleteEvent($id) {
		$event = MyEvent::find($id);
		$event->delete();
		return redirect()->back();
	}

	public function exportToExcel($event_type_id, $file_type) {
		if ($event_type_id == 1) {
			$events = MyEvent::orderBy('event_time', 'asc')
				->select(
					'my_events.id',
					\DB::raw("my_events.event_title"),
					'my_events.event_description',
					'my_events.event_venue',
					'my_events.event_date')
				->where('my_events.event_type_id', '=', $event_type_id)
				->get();

		} else if ($event_type_id == 2) {
			$events = MyEvent::orderBy('event_time', 'asc')
				->select(
					'my_events.id',
					\DB::raw("my_events.event_title"),
					'my_events.event_description',
					'my_events.event_venue',
					'my_events.event_date')
				->where('my_events.event_type_id', '=', $event_type_id)
				->get();

		} else {
			$events = MyEvent::orderBy('event_time', 'asc')
				->select(
					'my_events.id',
					\DB::raw("my_events.event_title"),
					'my_events.event_description',
					'my_events.event_venue',
					'my_events.event_date')
				->where('my_events.event_type_id', '=', $event_type_id)
				->get();

		}
		// $events = DB::select("select id, event_title, event_description, event_venue, event_date
		// 	from my_events
		// 	where my_events.event_type_id = " . $event_type_id . "
		// 	order by my_events.event_time asc");
		// return $events;

		// Initialize the array which will be passed into the Excel generator.
		$eventsArray = [];

		// Define the Excel spreadsheet headers
		$eventsArray[] = ['id', 'title', 'description', 'vanue', 'date'];

		// Convert each member of the returned collection into an array,
		// and append it to the events array.
		foreach ($events as $event) {
			$eventsArray[] = $event->toArray();
		}

		// Generate and return the spreadsheet
		Excel::create('my_events', function ($excel) use ($eventsArray) {

			// Set the spreadsheet title, creator, and description
			$excel->setTitle('Event');
			$excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
			$excel->setDescription('events file');

			// Build the spreadsheet, passing in the payments array
			$excel->sheet('sheet1', function ($sheet) use ($eventsArray) {
				$sheet->fromArray($eventsArray, null, 'A1', false, false);
			});

		})->download($file_type);
	}

}
