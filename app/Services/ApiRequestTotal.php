<?php

namespace App\Services;

use App\Facades\RedisFacade;

class ApiRequestTotal
{
    protected $redis;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redis = RedisFacade::connect();
    }

    /**
     * Set total.
     *
     * @return void
     */
    public function total()
    {
        $allKeys = RedisFacade::getKeys($this->redis);
        $allCount = 0;
        foreach ($allKeys as $key) {
            $allCount += RedisFacade::getKey($this->redis, $key);
        }
        RedisFacade::setKey($this->redis, $allCount);
    }
}
