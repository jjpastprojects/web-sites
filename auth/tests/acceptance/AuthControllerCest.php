<?php


class AuthControllerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function it_register_a_valide_user(AcceptanceTester $I)
    {
       $name = 'a';
       $email = 'a@a.a';
       $I->register(compact('name','email'));
       $I->dontSee('username');
       $I->seeInDatabase('users', ['username' => $name, 'email' => $email]);
    }

    public function it_try_to_register_a_user_with_invalid_inputs(AcceptanceTester $I)
    {
        $name = '';

        $I->register(compact('name'));

        $I->see('username');
    }

    public function it_login_a_user(AcceptanceTester $I)
    {
        $I->register();
        $I->login();
        $I->dontSee('email');
    }

    public function it_try_to_login_with_invalid_inputs(AcceptanceTester $I)
    {
        $email = 'wrong@email.com';
        $I->register();
        $I->login(compact('email'));
        $I->see('email');
    }

     public function it_try_to_login_with_unexisted_user(AcceptanceTester $I)
    {
        $I->login();
        $I->see('email');
    }

}
