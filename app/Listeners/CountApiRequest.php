<?php

namespace App\Listeners;

use App\Events\ApiRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class CountApiRequest
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ApiRequest  $event
     * @return void
     */
    public function handle(ApiRequest $event)
    {      
        if (Cache::has('api:users:' . \Auth::guard('api')->user()->id)) {
            Cache::increment('api:users:' . \Auth::guard('api')->user()->id);
        } else {
            Cache::add('api:users:' . \Auth::guard('api')->user()->id, 1);
        }
    }
}
