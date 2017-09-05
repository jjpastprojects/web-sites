<?php


class AuthControllerCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function it_register_a_valide_user(FunctionalTester $I)
    {
        $name = 'joe';
        $email = 'joe@gmail.com';
        $password = 'secret';
        $I->amOnRoute('user:register');
        $I->fillField('username',$name);
        $I->fillField('email',$email);
        $I->fillField('password',$password);
        $I->fillField('password_confirmation',$password);
        $I->click(Lang::get('form.register'));

        //$I->seePageIs(route('home'));
        //$I->seeInDatabase('users', ['username' => $name, 'email' => $email]);

    }
}
