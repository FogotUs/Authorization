<?php


namespace App\Http\Controllers\Auth\ChangePassword;

use App\Http\Controllers\Auth\BaseAuthController;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ResetPasswordController extends BaseAuthController
{
    public function create(Request $request)
    {
        return view('pages.auth.reset-password', ['request' => $request]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);
        return $this->passwordReset->resetPasswordStore($request);

    }

}
