<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class CheckExpiringJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for jobs expiring today and tomorrow';

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
     * @return int
     */
    public function handle()
    {
            // Instantiate the Guzzle Http client
            $client = new Client(['verify' => false]);

            // Define your API endpoint
            $url = 'http://192.168.1.43:8080/api/';
    
            // Call the API for today's expiring jobs
            $responseToday = $client->request('GET', $url.'today-expiry');
    
            // Call the API for tomorrow's expiring jobs
            $responseTomorrow = $client->request('GET', $url.'tmrw-expiry');
    
            // Log or do something with the responses
            $this->info('APIs called successfully.');
    
            return 0;
    }
}
