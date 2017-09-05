<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase {

    use DatabaseTransactions;

    public function register($overrides=[])
    {

        $email = array_key_exists('email', $overrides)?$overrides['email']:'joe@example.com';
        $password = array_key_exists('password', $overrides)?$overrides['password']:'secret';

        $this->visit(route('register'))
                ->type($email, 'email')
                ->type($password, 'password')
                ->press('Sign Up');
    }


    /**
    * @test
    */
    public function it_regiser_a_valide_user()
    {
              $email = 'joe@example.com';
              $this->register(compact('name', 'email'));
              $this->seePageIs(route('home'))
                   ->seeInDatabase('users', ['email' => $email]);
    }


    /**
    * @test
    */
    public function it_try_to_register_a_user_with_invalid_inputs()
    {
        $email = 'joe2';
        $password = 'secret';
        $this->visit(route('register'))
                ->type($email, 'email')
                ->type($password, 'password')
                ->seePageIs(route('register'));
    }


    /**
    * @test
    */
    public function it_login_a_user()
    {
        $email = 'joe@gmail.com';
        $password = 'password';

        $user = factory(App\Models\User::class)->create(['email' => $email, 'password' => Hash::make($password)]);

        $this->visit(route('login'))
             ->type($email, 'email')
             ->type($password, 'password')
             ->press('Sign In');

        $this->seePageIs(route('home'));
    }


    /**
    * @test
    */
    public function it_try_to_login_with_invalid_inputs()
    {
        $email = 'joe@gmail.com';
        $password = 'password';


         $this->visit(route('login'))
              ->type($password, 'password')
              ->press('Sign In');

        $this->seePageIs(route('login'));
    }


    /**
    * @test
    */
    public function it_try_to_login_with_unexisted_user()
    {
        $email = 'joe@gmail.com';
        $password = 'password';

         $this->visit(route('login'))
               ->type($email, 'email')
              ->type($password, 'password')
              ->press('Sign In');

        $this->seePageIs(route('login'));
    }

}
