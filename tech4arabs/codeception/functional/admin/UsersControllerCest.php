<?php

class UsersControllerCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function it_show_all_users(FunctionalTester $I)
    {
        $user = createProfile()->user;

        $user->assignRole(1);

        \Auth::loginUsingId($user->id);

        $I->amOnRoute('admin::show_users');

        $I->see($user->username);
        $I->seeCurrentUrlEquals('/show_users');
    }

    public function it_redirect_the_user_when_he_is_not_an_admin(FunctionalTester $I)
    {
        $user = createProfile()->user;

        \Auth::loginUsingId($user->id);

        $I->amOnRoute('admin::show_users');

        $I->seeCurrentUrlEquals('/');
    }

    public function it_redirect_the_user_when_he_is_sign_in(FunctionalTester $I)
    {
        $I->amOnRoute('admin::show_users');

        $I->seeCurrentUrlEquals('/login');
    }

    public function it_delete_a_user(FunctionalTester $I)
    {
        $user = createProfile()->user;

        $user->assignRole(1);

        \Auth::loginUsingId($user->id);

        $I->amOnRoute('admin::show_users');


    }

}
