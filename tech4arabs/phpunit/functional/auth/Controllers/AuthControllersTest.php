<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase {

    use DatabaseTransactions;

    /**
    * @test
    */
    public function it_regiser_a_valide_user()
    {
        $name = 'joe';
        $email = 'joe@gmail.com';
        $password = 'secret';
        $this->visit(route('auth::register'))
                ->type($name, 'username')
                ->type($email, 'email')
                ->type($password, 'password')
                ->type($password, 'password_confirmation')
                ->press(Lang::get('form.register'))
                ->seePageIs(route('core::home'))
                ->seeInDatabase('users', ['username' => $name, 'email' => $email]);
    }


    /**
    * @test
    */
    public function it_try_to_register_a_user_with_invalid_inputs()
    {
        $email = 'joe2@gmail.com';
        $password = 'secret';
        $this->visit(route('auth::register'))
                ->type($email, 'email')
                ->type($password, 'password')
                ->type($password, 'password_confirmation')
                ->press(Lang::get('form.register'))
                ->seePageIs(route('auth::register'));
    }


    /**
    * @test
    */
    public function it_login_a_user()
    {
        $email = 'joe@gmail.com';
        $password = 'password';

        $user = createUser(['email' => $email, 'password' => Hash::make($password)]);

        $this->visit(route('auth::login'))
             ->type($email, 'email')
             ->type($password, 'password')
             ->press(Lang::get('form.login'));

        $this->seePageIs(route('core::home'));
    }


    /**
    * @test
    */
    public function it_try_to_login_with_invalid_inputs()
    {
        //Arrange
        $email = 'joe@gmail.com';
        $password = 'password';


        //Act
         $this->visit(route('auth::login'))
              ->type($password, 'password')
              ->press(Lang::get('form.login'));

        //Assert
        $this->seePageIs(route('auth::login'));
    }


    /**
    * @test
    */
    public function it_try_to_login_with_unexisted_user()
    {
        //Arrange
        $email = 'joe@gmail.com';
        $password = 'password';

        //Act
         $this->visit(route('auth::login'))
               ->type($email, 'email')
              ->type($password, 'password')
              ->press(Lang::get('form.login'));

        //Assert
        $this->seePageIs(route('auth::login'));
    }


}
