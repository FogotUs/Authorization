<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseAuthController
{
    public function create()
    {
        return view('pages.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required | string | email',
            'password' => 'required | string ',
        ]);
       $this->authService->loginStore($request, $credentials);
    }

    public function destroy(Request $request)
    {
       $this->authService->loginDestroy($request);
    }

}
