<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Authorization\AuthorizationService;
use App\Services\Authorization\PasswordResetService;
use App\Services\Authorization\RedisService;

class BaseAuthController extends Controller
{
    public function __construct(
        public AuthorizationService $authService,
        public RedisService         $redis,
        public PasswordResetService $passwordReset
    )
    {
    }
}
