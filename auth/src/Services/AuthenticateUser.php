<?php

namespace Lembarek\Auth\Services;

use Laravel\Socialite\Contracts\Factory as Socialite;
use Lembarek\Auth\Repositories\UserRepository;

class AuthenticateUser
{
    protected $userRepo;

    protected $socialite;

    public function __construct(UserRepository $userRepo, Socialite $socialite)
    {
        $this->userRepo = $userRepo;
        $this->socialite = $socialite;
    }

    /**
     * it authenticate user
     *
     * @param  string  $provider
     * @param Request  $request
     * @return User
     */
    public function authenticate($provider, $code=False)
    {
        if($code){
            return $this->handleProviderCallback($provider);
        }

        return $this->redirectToProvider($provider);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $provider
     *
     * @return Response
     */
    private function redirectToProvider($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param string $provider
     *
     * @return Response
     */
    private function handleProviderCallback($provider)
    {
        $providerUser = $this->socialite->driver($provider)->user();

        return $this->findOrCreateUser($providerUser);
     }

     /**
     * Return user if exists; create and return if doesn't
     *
     * @param $providerUser
     * @return User
     */
    private function findOrCreateUser($providerUser)
    {
        if ($user = $this->userRepo->findBy('email', $providerUser->getEmail())) {
            return $user;
        }

        return $this->userRepo->create([
            'username' => $providerUser->getNickname(),
            'email' => $providerUser->getEmail(),
        ]);
    }


}
