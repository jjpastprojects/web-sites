<?php

class PasswordControllerCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function it_reset_password(FunctionalTester $I)
    {
        $I->resetEmails();

        $email = 'jane@example.com';

        createUser(['email' => $email]);

        $I->amOnRoute('auth::login');
        $I->see('forget your password');
        $I->click('forget your password');
        $I->see('email');
        $I->fillField('input[name=email]', $email);
        $I->click('submit');

        $I->seeRecord('password_resets', ['email' => $email]);

        $token = \Lembarek\Auth\Models\ResetPassword::whereEmail($email)->first()->token;

        $I->seeInLastEmail("Please click this link to reset your password");
        $I->seeInLastEmail("$email");
        $I->seeInLastEmail(Route('auth::reset_password', ['email' => $token]));

        $I->amonRoute('auth::reset_password', compact('token'));

        $I->fillField('input[name=password]', 'password');
        $I->fillField('input[name=password_confirmation]', 'password');
        $I->click('submit');

        $I->dontSeeRecord('password_resets', ['email' => $email]);

        $I->seeRecord('users', ['email' => $email, 'password' => 'password']);
    }


}
