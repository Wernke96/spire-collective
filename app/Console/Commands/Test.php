<?php

namespace App\Console\Commands;

use App\SpireCollective\Infrastructure\BigCommerce\Models\BigCommerceModel;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spire:test';

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
     *
     */
    public function handle()
    {
        $client = new Client(['base_uri' => 'http://httpbin.org']);
        $bigCommerce = new BigCommerceModel($client);
        dd($bigCommerce->getOrder(1));
    }
}
