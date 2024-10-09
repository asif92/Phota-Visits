<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyEvent;
use Carbon\Carbon;

class HelpDeskController extends Controller {

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('helpdesk');
	}
	public function helpDeskEventList() {
		$current_date = Carbon::today()->format('Y-m-d');

		$events = MyEvent::orderBy('event_time', 'asc')->where('event_date', $current_date)->get();

		$arrived_part = MyEvent::orderBy('event_time', 'asc')->where('event_date', $current_date)->with(['MyEventParticipants' => function ($query) {
			$query->where('status_id', '!=', 1);
		}])->where('event_confirmation_approval', 1)->get();

		$total_part = 0;

		$remaining_part = MyEvent::orderBy('event_time', 'asc')->where('event_date', $current_date)->with(['MyEventParticipants' => function ($query) {
			$query->where('status_id', 1);
		}])->where('event_confirmation_approval', 1)->get();

		$arrived_part_data = json_decode($arrived_part);
		for ($i=0; $i < count($arrived_part_data); $i++)
		{
			$total_part = $total_part + count($arrived_part_data[$i]->my_event_participants);
		}

		$remaining_part_data = json_decode($remaining_part);
		for ($i=0; $i < count($remaining_part_data); $i++)
		{
			$total_part = $total_part + count($remaining_part_data[$i]->my_event_participants);
		}

		// $arrived_part = json_decode($arrived_part);
		// $remaining_part = json_decode($remaining_part);

		return view('Users.helpDesk', compact('events', 'arrived_part', 'remaining_part', 'total_part'));
	}

	public function helpDeskWatcher(Request $request) {
		// return $request->selected_event_id;
		$event_id = $request->selected_event_id;
		$current_date = Carbon::today()->format('Y-m-d');
		$arrived_part = MyEvent::orderBy('event_time', 'asc')->where('event_date', $current_date)->with(['MyEventParticipants' => function ($query) {
			$query->where('status_id', '!=', 1);
		}])->find($event_id);

		$remaining_part = MyEvent::orderBy('event_time', 'asc')->where('event_date', $current_date)->with(['MyEventParticipants' => function ($query) {
			$query->where('status_id', 1);
		}])->find($event_id);

		$data = ['arrived_part' => count($arrived_part->MyEventParticipants), 'remaining_part' => count($remaining_part->MyEventParticipants), 'total_part' => (count($arrived_part->MyEventParticipants) + count($remaining_part->MyEventParticipants))];
		return $data;

	}

	public function HelpDeskEventsWatcher() {
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

}
