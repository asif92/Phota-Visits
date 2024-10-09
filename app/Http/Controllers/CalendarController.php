<?php

namespace App\Http\Controllers;

use App\EventType;
use App\MyEvent;

class CalendarController extends Controller {
	public function calendarJson() {
		return MyEvent::with('EventType')->get();
	}
	public function Calendar() {
		$event_type = EventType::all();
		$eventdata = MyEvent::with('EventType')->get();
		$event_name = '';
		return view('Pages.Calendar', compact('event_name', 'eventdata', 'event_type'));
	}
}
