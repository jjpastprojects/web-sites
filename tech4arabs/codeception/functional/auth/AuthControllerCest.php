<?php


class AuthControllerCest
{
    public function _before(FunctionalTester $I)
    {
       $I->disableEvents();
    }

    public function _after(FunctionalTester $I)
    {
    }

   public function it_register_a_valide_user(FunctionalTester $I)
    {
       $username = 'a';
       $email = 'a@a.a';
       $I->register(compact('username','email'));
       $I->seeCurrentRouteIs('core::home');
       $I->seeRecord('users', ['username' => $username, 'email' => $email]);
    }

    public function it_try_to_register_a_user_with_invalid_inputs(FunctionalTester $I)
    {
        $username = '';

        $I->register(compact('username'));

        $I->seeCurrentRouteIs('auth::register');
    }

    public function it_dispatch_userHasCreated_event(FunctionalTester $I)
    {
       $username = 'a';
       $email = 'a@a.a';
       $I->register(compact('username','email'));
       $I->seeEventTriggered('Lembarek\Auth\Events\UserHasCreated');
    }

    public function it_login_a_user(FunctionalTester $I)
    {
        $password= 'password';
        $email = 'a@a.a';
        $username = 'a';

        $I->register(compact('password', 'email','username'));
        $I->seeCurrentRouteIs('core::home');
        $I->login(compact('password', 'email'));
        $I->seeCurrentRouteIs('core::home');
    }

    public function it_try_to_login_with_invalid_inputs(FunctionalTester $I)
    {
        $email = 'wrong@email.com';
        $I->register();
        $I->login(compact('email'));
        $I->see('email');
    }

     public function it_try_to_login_with_unexisted_user(FunctionalTester $I)
    {
        $email = 'nouser@example.com';
        $I->login(compact('email'));
        $I->see('email');
    }

}
