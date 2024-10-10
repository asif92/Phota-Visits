<?php

namespace App;

use App\Mail\NotifyParticipant;
use App\MyEvent;
use Illuminate\Support\Facades\Mail;

class Util {
	public function sendEmail($id) {

		$singleEvent = MyEvent::find($id);
		$allParticipants = $singleEvent->MyEventParticipants;

		foreach ($allParticipants as $singleParticipant) {

			Mail::to($singleParticipant->participant->participant_email)->send(new NotifyParticipant($singleEvent, $singleParticipant->participant));
		}

		return 200;
	}
	public function sendSms($id) {

		$singleEvent = MyEvent::find($id);
		$allParticipants = $singleEvent->MyEventParticipants;

		$username = env('SMS_PROVIDER_USERNAME', 'username');
		$password = env('SMS_PROVIDER_PASSWORD', 'password');

		$sender = env('SMS_PROVIDER_SENDER', 'username');

		foreach ($allParticipants as $singleParticipant) {

			$mobile = $singleParticipant->participant->participant_contact;
			$message = "Dear " . $singleParticipant->participant->participant_name . ". Your meeting at Punjab Human Organ Transplan Authority office with" . $singleEvent->inviting_official . " has been confirmed on  " . $singleEvent->event_date . " at " . $singleEvent->event_time;

			$url = env('SMS_PROVIDER') . "?username=" . $username . "&password=" . $password . "&mobile=" . $mobile . "&sender=" . urlencode($sender) . "&message=" . urlencode($message) . "";
			// dd($url);
			$ch = curl_init();
			$timeout = 30;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$responce = curl_exec($ch);
			curl_close($ch);
			// dd($responce);
		}

		return 200;
	}

}