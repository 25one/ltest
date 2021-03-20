<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flugg\Responder\Responder;
use App\Facades\RedisFacade;

class StatsController extends Controller
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
     * Display stats of all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        //$stats['all'] = $this->redis->get('test_database_test_cache:api-total-requests');
        $stats['all'] = RedisFacade::getAll($this->redis);
        
        if (! $stats) {
            return responder()
            ->error()
            ->respond();
        }        
        
        return responder()
        ->success($stats)
        ->respond();                
    }
    
    /**
     * Display stats of auth-user.
     *
     * @return \Illuminate\Http\Response
     */
    public function statsMy()
    {
        //$stats['user'] = $this->redis->get('test_database_test_cache:api:users:' . auth()->user()->id);
        $stats['user'] = RedisFacade::getOne($this->redis, auth()->user()->id);
        
        if (! $stats) {
            return responder()
            ->error()
            ->respond();
        }
        
        return responder()
        ->success($stats)
        ->respond();            
    }
}
