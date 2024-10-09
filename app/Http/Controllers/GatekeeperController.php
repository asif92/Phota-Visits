<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventVehicle;
use App\MyEvent;
use App\MyEventParticipant;
use Carbon\Carbon;

class GatekeeperController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('gatekeeper');
	}

	public function gatekeeperEventList() {
		$current_date = Carbon::today()->format('Y-m-d');

		// $events = MyEvent::all();
		$events = MyEvent::orderBy('event_time', 'asc')->where('event_date', $current_date)->where('event_confirmation_approval', 1)->get();
		return view('Users.Gatekeeper', compact('events'));
	}

	public function GateKeeperEventsWatcher() {
		$current_date = Carbon::today()->format('Y-m-d');
		$events = MyEvent::with('eventStatus')->orderBy('event_time', 'asc')->where('event_date', $current_date)->get();
		$now = Carbon::now()->timezone('Asia/Karachi')->toTimeString();
		for ($i = 0; $i < count($events); $i++) {

			$end_time = Carbon::parse($events[$i]->event_time)->addMinutes($events[$i]->time_span)->toTimeString();
			if ($end_time < $now) {
				$event = MyEvent::find($events[$i]->id);
				if ($event->event_status_id != 5) {
					$event->event_status_id = 6;
				}

				$event->save();
			}

		}
		return $events;

		// $end_time = Carbon::parse($events[3]->event_time)->addMinutes($events[3]->time_span)->toTimeString();
		// if ($end_time < $now) {
		// 	return "Past";
		// } else {
		// 	return "Others";
		// }

	}

// //Test
	// 	public function gatekeeperList()
	// 	{

// 		$current_date = Carbon::today()->format('Y-m-d');

// 		$events = MyEvent::with('MyEventParticipants.participant')->with('eventVehicles.vehicle')->orderBy('event_time', 'asc')->where('event_type_id',1)->where('event_date',$current_date)->get();
	// 		return $events;
	// 	}

	public function gatekeeperParticipantArrivalSuccess($event_part_id) {
		$eParticipant = MyEventParticipant::find($event_part_id);
		$eParticipant->status_id = 2;
		$eParticipant->save();
		return 200;
	}

	public function gatekeeperParticipantArrivalCancel($event_part_id) {
		$eParticipant = MyEventParticipant::find($event_part_id);
		$eParticipant->status_id = 1;
		$eParticipant->save();
		return 200;
	}

	public function gatekeeperVehicleArrivalSuccess($event_vehicle_id) {
		$eVehicle = EventVehicle::find($event_vehicle_id);
		$eVehicle->status_id = 2;
		$eVehicle->save();
		return 200;
	}

	public function gatekeeperVehicleArrivalCancel($event_vehicle_id) {
		$eVehicle = EventVehicle::find($event_vehicle_id);
		$eVehicle->status_id = 1;
		$eVehicle->save();
		return 200;
	}

	public function GateKeeperWatcher(Request $request) {
		// return $request->selected_event_id;
		$event_id = $request->selected_event_id;
		$current_date = Carbon::today()->format('Y-m-d');

		$events = MyEvent::with(['MyEventParticipants.participant', 'MyEventParticipants.status'])->with(['eventVehicles.vehicle', 'eventVehicles.status'])->orderBy('event_time', 'asc')->where('event_date', $current_date)->where('id', $event_id)->find($event_id);

		return $events;
	}

}
