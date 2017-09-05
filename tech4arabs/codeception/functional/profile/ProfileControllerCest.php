<?php


use Lembarek\Auth\Events\UserHasCreated;
use Lembarek\Profile\Models\Profile;

class ProfileControllerCest
{



    public function _before(FunctionalTester $I)
    {
        $this->user_id = createProfile()->user_id;

        \Auth::loginUsingId($this->user_id);
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function it_show_all_variables_and_its_values(FunctionalTester $I)
    {
        $I->amOnRoute('profile::index');
        $I->see('country');
        $I->see('sex');
        $I->see('birth_date');
        $I->seeCurrentUrlEquals('/profile');
    }

    public function it_change_the_country(FunctionalTester $I)
    {
        $I->changeProfileEnumValue($this->user_id, 'country', 'united states', 'algeria');
    }

    public function it_change_the_date(FunctionalTester $I)
    {
        $I->changeProfileTextValue($this->user_id, 'birth_date', '0000-00-00', '1991-01-01');
    }

    public function it_change_the_sex(FunctionalTester $I)
    {
        $I->changeProfileEnumValue($this->user_id, 'sex', 'male', 'female');
    }

    public function it_show_and_return_back_when_the_user_provide_invalid_date(FunctionalTester $I)
    {

        $I->seeRecord('profiles', ['birth_date' => '0000-00-00']);

        $I->amOnPage('/profile');
        $I->click("0000-00-00");

        $I->fillField("input[name='birth_date']","1991-13-13");
        $I->click("button[type='submit']");

        $I->seeCurrentUrlEquals('/profile/birth_date/edit');

        $I->seeFormErrorMessage('birth_date', 'The birth date is not a valid date.');

    }

    public function it_try_to_profide_invalid_value_to_sex(FunctionalTester $I)
    {
        $I->seeRecord('profiles', ['sex' => 'male']);

        $I->amOnPage('/profile');
        $I->click("male");

        $I->see('male');
        $I->see('female');

        //$I->selectOption("select[name='sex']","foo");

        //$I->click("button[type='submit']");

       //$I->seeRecord('profiles', ['user_id' => 1, 'country' => '1991-15-01']);
    }

    public function it_create_a_default_profile_when_a_new_user_register(FunctionalTester $I)
    {
       $user = createUser();
       event(new UserHasCreated($user));
       $I->seeRecord('profiles', ['user_id' => $user->id, 'country' => 'united states', 'sex' => 'male','birth_date' => '0000-00-00']);
    }

}
