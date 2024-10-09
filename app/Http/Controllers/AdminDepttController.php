<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyEvent;
use App\MyEventParticipant;
use Carbon\Carbon;

class AdminDepttController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('admindept');
	}
	public function AdminDepttEventList() {
		$current_date = Carbon::today()->format('Y-m-d');

		$events = MyEvent::orderBy('event_time', 'asc')->where('event_date', $current_date)->where('event_confirmation_approval', 1)->get();
		// dd($events);
		return view('Users.AdminDeptt', compact('events'));
	}

	public function admindepttParticipantArrivalSuccess($event_part_id) {
		$eParticipant = MyEventParticipant::find($event_part_id);
		$eParticipant->status_id = 3;
		$eParticipant->save();
		return 200;
	}

	public function admindepttParticipantArrivalCancel($event_part_id) {
		$eParticipant = MyEventParticipant::find($event_part_id);
		$eParticipant->status_id = 2;
		$eParticipant->save();
		return 200;
	}

	public function AdminDeptWatcher(Request $request) {
		// return $request->selected_event_id;
		$event_id = $request->selected_event_id;
		$current_date = Carbon::today()->format('Y-m-d');

		$events = MyEvent::with(['MyEventParticipants.participant', 'MyEventParticipants.status'])->orderBy('event_time', 'asc')->where('event_date', $current_date)->where('id', $event_id)->find($event_id);

		return $events;
	}

	public function AdminDeptEventsWatcher() {
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
	}
	// public function getEventTypeId($event_type_id) {
	// 	return $event_type_id;
	// }

}
