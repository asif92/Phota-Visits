<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestSMSApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Send Sms Api';

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
        $this->info("Sms api test start...");
        $this->info("Sms api test end...");
    }
}


