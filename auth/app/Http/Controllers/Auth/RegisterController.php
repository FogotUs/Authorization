<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Facades\Agent;

class RegisterController extends BaseAuthController
{
    public function create()
    {
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | string | email | unique:users',
            'password' => 'required | confirmed | min:8',
        ]);
        ValidationException::withMessages([
            'email' => 'Почта не соответствует'
        ]);
        $user = $this->authService->registrationStore($request);
        $this->hashCreate(Agent::browser() . Agent::platform() . $request->name . $request->email, $user->salt);


        return redirect(RouteServiceProvider::HOME);
    }

}
