<?php

namespace App\Listeners;

use App\Events\SendEmailSMSEvent;
use Facades\App\Util;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailSMSListener implements ShouldQueue {
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  SendEmailSMSEvent  $event
	 * @return void
	 */
	public function handle(SendEmailSMSEvent $event) {
		Util::sendEmail($event->event_id);
		Util::sendSms($event->event_id);
	}
}
