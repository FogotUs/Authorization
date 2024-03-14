<?php

namespace App\Services\Authorization;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class RedisService
{
    private const TTL = 7200;
    public function __construct(
        protected readonly Redis $cache
    )
    {
    }

    public function getCacheByKey(string $key): void
    {
        $this->cache->get($key);
    }

    public function setRedisKey(string $key): void
    {
        $this->cache::put($key, self::TTL);
    }

}
