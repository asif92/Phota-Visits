<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MyEvent;

class smstest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:test {event_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("-------------------");
        $this->info("Sms api test start...");
        $this->info("-------------------");

        $singleEvent = MyEvent::find($this->argument('event_id'));
        $allParticipants = $singleEvent->MyEventParticipants;

        $username = env('SMS_PROVIDER_USERNAME', 'username');
        $password = env('SMS_PROVIDER_PASSWORD', 'password');

        $sender = env('SMS_PROVIDER_SENDER', 'username');

        foreach ($allParticipants as $singleParticipant)
        {
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

        $this->info("-------------------");
        $this->info("Sms api test end...");
        $this->info("-------------------");
    }
}











