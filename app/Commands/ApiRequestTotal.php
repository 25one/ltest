<?php

namespace App\Commands;

use App\Services\ApiRequestTotal as ServiceTotal;

class ApiRequestTotal
{
    /**
     * Execute the schedule task.
     *
     * @return mixed
     */
    public function __invoke(ServiceTotal $total)
    {
        $total->total();
    }
}
