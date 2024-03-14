<?php

namespace App\Services\Authorization;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use PhpParser\Node\Expr\Cast\Object_;


class AuthorizationService
{
    public function hashCreate(string $hashableString, int $salt):string
    {
        return md5($hashableString.$salt);
    }

    /**
     * @param Request $request
     * @return Object
     * @throws \Random\RandomException
     *
     * Сохраняет данные пользователя в БД
     */
    public function registrationStore(Request $request) : Object {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'salt' => random_int(1, 2147483647),
            'password' => Hash::make($request->password)
        ]);
        event(new Registered($user));
        Auth::login($user);
        return $user;
    }

    /**
     * @param Request $request
     * @param array $credentials
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     * Авторизует пользователя- проверяет на наличие реквизитов в БД и если они есть, то авторизует и редирект на главную
     */
    public function loginStore(Request $request, array $credentials){

        if(!Auth::attempt($credentials, $request->boolean('remember'))){
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.'
            ]);
        }
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Выход пользователя из системы
     */

    public function loginDestroy(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('main');
    }
}
