<?php

namespace App\Http\Controllers\Auth\ChangePassword;

use App\Http\Controllers\Auth\BaseAuthController;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ForgotPasswordController extends BaseAuthController
{
    public function create()
    {
        return View('pages.auth.forgot');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'email']
            ]);
        return $this->passwordReset->forgotPasswordStore($request);

    }
}
