<?php

use PHPUnit_Framework_Assert as ph;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

   /**
    * Define custom actions here
    */

     /**
     * it register a user
     *
     * @param  array  $overrides
     * @return void
     */
    public function register(array $overs=[])
    {
        $username = 'joe doe';
        $email = 'joe@example.com';
        $password = 'secret';

        extract($overs);

        $this->amOnRoute('auth::register');
        $this->fillField('username',$username);
        $this->fillField('email',$email);
        $this->fillField('password',$password);
        $this->fillField('password_confirmation',$password);
        $this->click('input[type=submit]');

    }


    /**
     * it login a user
     *
     * @param  array  $overs
     * @return void
     */
    public function login(array $overs=[])
    {
        $email = 'joe@example.com';
        $password = 'password';

        extract($overs);

        $this->amOnRoute('auth::login');
        $this->fillField('email', $email);
        $this->fillField('password', $password);
        $this->click('input[type=submit]');
    }

    public function seeExceptionThrown($exception, $function)
    {
        try
        {
            $function();
            return false;
        } catch (Exception $e) {
            if( get_class($e) == $exception ){
                return true;
            }
            return false;
        }
    }

    /**
     * check if json file contain json string
     *
     * @param  string  $json1
     * @param  string  $json2
     * @return boolean
     */
    public function assertJsonStringContainsJsonString($json1, $json2)
    {
        $json1= json_decode($json1, true);
        $json2= json_decode($json2, true);
        return ph::assertArraySubset($json1, $json2);
    }

   public function changeProfileEnumValue($user_id, $field, $old, $new)
    {

        $this->seeRecord('profiles', [$field => $old]);

        $this->amOnPage('/profile');

        $this->click($old);

        $this->seeOptionIsSelected("select[name='$field']", $old);

        $this->selectOption("select[name='$field']",$new);

        $this->click("button[type='submit']");

        $this->seeCurrentUrlEquals('/profile');

        $this->seeRecord('profiles', ['user_id' => $user_id, $field => $new]);

    }

  public function changeProfileTextValue($user_id, $field, $old, $new)
    {

        $this->seeRecord('profiles', [$field => $old]);

        $this->amOnPage('/profile');

        $this->click($old);

        $this->fillField("input[name='$field']","$new");

        $this->click("button[type='submit']");

        $this->seeCurrentUrlEquals('/profile');

        $this->seeRecord('profiles', ['user_id' => $user_id, $field => $new]);

    }





}
