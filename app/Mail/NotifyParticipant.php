<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyParticipant extends Mailable {
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */

	public $event_detail;
	public $participant_detail;
	public function __construct($event_detail, $participant_detail) {
		$this->event_detail = $event_detail;
		$this->participant_detail = $participant_detail;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {

		return $this->subject('Meeting Invitation from Punjab Human Organ Transplant Authority')
			->view('email.participant_notify', compact($this->event_detail, $this->participant_detail));
	}
}
