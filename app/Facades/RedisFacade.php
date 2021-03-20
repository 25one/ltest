<?php

namespace App\Facades;

class RedisFacade
{  
    /**
     * Connect to redis.
     *
     * @return void
     */
    public static function connect()
    {
        $redis = new \Redis();
        $redis->connect('redis', 6379);
        return $redis;
    }   
    
    /**
     * Get stats of one user.
     *
     * @return array
     */
    public static function getOne($redis, $user)
    {
        return $redis->get('test_database_test_cache:api:users:' . $user);
    }
    
    /**
     * Get stats of all user.
     *
     * @return array
     */
    public static function getAll($redis)
    {
        return $redis->get('test_database_test_cache:api-total-requests');
    }

    /**
     * Get one key from redis.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getKey($redis, $key)
    {
        return $redis->get($key);
    }
    
    /**
     * Get all keys from redis.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getKeys($redis)
    {
        return $redis->keys('test_database_test_cache:api:users:*');
    }
    
    /**
     * Set value of key.
     *
     * @return \Illuminate\Http\Response
     */
    public static function setKey($redis, $value)
    {
        $redis->set('test_database_test_cache:api-total-requests', $value);
    }
}
