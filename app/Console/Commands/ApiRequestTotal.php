<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiRequestTotal as ServiceTotal;

class ApiRequestTotal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apirequesttotal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'getting all api-requests';

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
    public function handle(ServiceTotal $total)
    { 
        $total->total();
    }
}
