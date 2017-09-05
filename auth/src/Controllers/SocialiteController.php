<?php

namespace Lembarek\Auth\Controllers;

use Illuminate\Http\Request;
use Lembarek\Auth\Services\AuthenticateUser;

class SocialiteController extends Controller
{
    protected $authenticateUser;

    public function __construct(AuthenticateUser $authenticateUser)
    {
        $this->authenticateUser = $authenticateUser;
    }

    /**
     * log a user using socialite
     *
     * @param  string  $provider
     * @return Response
     */
    public function login($provider, Request $request)
    {
        $user = $this->authenticateUser->authenticate($provider, $request->has('code'));

        auth()->login($user, true);

        return redirect()->intended(route('core::home'));

    }

}
