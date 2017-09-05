<?php


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
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

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
        $name = 'joe';
        $email = 'joe@example.com';
        $password = 'secret';

        extract($overs);

        $this->amOnPage('/register');
        $this->fillField('username',$name);
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
        $password = 'secret';

        extract($overs);

        $this->amOnPage('/login');
        $this->fillField('email', $email);
        $this->fillField('password', $password);
        $this->click('input[type=submit]');
    }




}
