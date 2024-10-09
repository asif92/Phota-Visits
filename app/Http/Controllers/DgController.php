<?php

namespace App\Http\Controllers;
use App\Events\SendEmailSMSEvent;
use App\ExtrnalEvents;
use App\MyEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DgController extends Controller {

	protected $meeting_type = '';
	protected $meeting_type_name = '';
	protected $current_url = '';

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('superadmin');
		if (\Request::is('superadmin/meeting/*')) {
			$this->meeting_type = 1;
			$this->current_url = 'superadmin/meeting';
			$this->meeting_type_name = "Meeting";
		} else if (\Request::is('superadmin/private_meeting/*')) {
			$this->meeting_type = 2;
			$this->current_url = 'superadmin/private_meeting';
			$this->meeting_type_name = "Private Meeting";
		} else if (\Request::is('superadmin/visit/*')) {
			$this->meeting_type = 3;
			$this->current_url = 'superadmin/visit';
			$this->meeting_type_name = "Visit";
		} else {
			$this->meeting_type = 1;
		}

	}

	public function allEvents($event_type) {

		// session()->flash('message', '<h1>Welcome! <strong> Director General </strong>  PHOTA</h1>');
		// // session('message');

		$current_date = Carbon::today()->format('Y-m-d');

		if (isset($event_type)) {
			$loadEvents = $event_type;
		} else {
			$loadEvents = 'today';
		}

		if ($loadEvents == 'today') {
			$events = MyEvent::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->where('event_type_id', $this->meeting_type)->where('event_date', $current_date)->where('event_confirmation_approval', 0)->paginate(10);
		} else if ($loadEvents == 'upcoming') {
			$events = MyEvent::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->where('event_type_id', $this->meeting_type)->where('event_date', '>', $current_date)->where('event_confirmation_approval', 0)->paginate(10);
		} else {
			$events = MyEvent::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->where('event_type_id', $this->meeting_type)->where('event_confirmation_approval', 0)->paginate(10);
		}

		$event_name = $this->meeting_type_name;
		$event_type_id = $this->meeting_type;
		$current_URL = $this->current_url;
		$selected_event_type = $loadEvents;

		return view('DG.Pages.Meetings', compact('events', 'event_name', 'event_type_id', 'current_URL', 'selected_event_type'));

	}

	public function meetingApproval($event_id, $approval) {
		$event = MyEvent::find($event_id);
		$event->event_confirmation_approval = $approval;
		$event->save();
		event(new SendEmailSMSEvent($event_id));
		return redirect()->back();

	}

	public function outgoingEvents() {
		$events = ExtrnalEvents::orderBy('event_date', 'desc')->orderBy('event_time', 'asc')->where('event_confirmation_approval', 0)->paginate(10);
		return view('DG.Pages.outgoing', compact('events'));
	}

	public function externalMeetingApproval($event_id, $approval) {
		$event = ExtrnalEvents::find($event_id);
		$event->event_confirmation_approval = $approval;
		$event->save();
		return redirect()->back();

	}

	// public function dgOutgoing() {
	// 	return view('DG.Pages.outgoing');
	// }
	public function dgVisits() {
		return view('DG.Pages.Visitor');
	}
	public function dgStaff() {
		return view('DG.Pages.Staff');
	}
	public function dgCalendar() {
		return view('DG.Pages.Calendar');
	}

}
