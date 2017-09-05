<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase {

    use DatabaseTransactions;

        /**
        * @test
        */
        public function it_regiser_a_valide_user()
        {
            $name = 'lembarek2';
            $email = 'lem2@gmail.com';
            $password = 'secret';
            $this->visit('/auth/register/')
                 ->type($name, 'name')
                 ->type($email, 'email')
                 ->type($password, 'password')
                 ->type($password, 'password_confirmation')
                 ->press("Register")
                 ->seePageIs('/home')
                 ->seeInDatabase('users', ['name' => $name, 'email' => $email])
                 ->seeInDatabase('user_variables', ['variable_id' => 1]);
        }


        /**
        * @test
        * @dataProvider data_provider_for_it_try_to_register_a_user_with_invalid_input
        */
        public function it_try_to_register_a_user_with_invalid_input($name, $email, $password, $password_confirmation, $errorMessage)
        {
                $this->visit('/auth/register/')
                 ->type($name, 'name')
                 ->type($email, 'email')
                 ->type($password, 'password')
                 ->type($password_confirmation, 'password_confirmation')
                 ->press("Register")
                 ->seePageIs('/auth/register/')
                 ->see($errorMessage);

        }


        public function data_provider_for_it_try_to_register_a_user_with_invalid_input()
        {
            return[
            ['john', 'john@gmail.com', 'foo', 'notfoo','the password must be at least 6 characters.'],
            ['john', 'john@gmail.com', 'foobar', 'notfoobar','the password confirmation does not match.'],
            ['john', 'notValidEmail', 'foobar', 'foobar','The email must be a valid email address.'],
            ];
        }


        /**
        * @test
        */
        public function it_login_a_valide_user()
        {
                $user = factory(Lem\User\Models\User::class)->create(['password' => bcrypt('secret')]);
                 $this->visit('/auth/login/')
                 ->type($user['email'], 'email')
                 ->type('secret', 'password')
                 ->press('Login')
                 ->seePageIs('/home');
        }


        /**
        * @test
        */
        public function it_login_a_valide_user_with_remember_me()
        {
                $user = factory(Lem\User\Models\User::class)->create(['password' => bcrypt('secret')]);
                 $this->visit('/auth/login/')
                 ->type($user['email'], 'email')
                 ->type('secret', 'password')
                 ->check('remember')
                 ->press('Login')
                 ->seePageIs('/home');
        }


        /**
        * @test
        */
        public function it_test_the_forget_your_password_system()
        {
            $user = factory(Lem\User\Models\User::class)->create();
            $this->visit('/auth/login')
                ->click('Forgot Your Password?')
                ->seePageIs('password/email/')
                ->type($user['email'], 'email')
                ->press('Send Password Reset Link')
                ->seePageIs('password/email')
                ->see('We have e-mailed your password reset link!')
                ->seeInDatabase('password_resets', ['email' => $user['email']]);

                $token = DB::table('password_resets')->whereEmail($user['email'])->first()->token;

                $this->visit('/password/reset/'.$token)
                    ->type($user['email'], 'email')
                    ->type('new password', 'password')
                    ->type('new password', 'password_confirmation')
                    ->press('Reset Password')
                    ->seePageIs('/home');

        }


        /**
        * @test
        * @dataProvider data_provider_for_it_try_to_login_a_user_with_invalid_input
        */
        public function it_try_to_login_a_user_with_invalid_input($email, $password, $errorMessage)
        {
                $this->visit('/auth/login/')
                 ->type($email, 'email')
                 ->type($password, 'password')
                 ->press("Login")
                 ->seePageIs('/auth/login/')
                 ->see(trans($errorMessage));

        }


        public function data_provider_for_it_try_to_login_a_user_with_invalid_input()
        {
            return[
            ['john@gmail.com', 'incorrectPassword','login.incorrect_inputs'],
            ['does@not.exists', 'password', 'login.incorrect_inputs'],
            ];
        }


        /**
        * @test
        */
        public function it_logout_a_valide_user()
        {
                $this->actingAs(User::find(1))
                    ->visit('/')
                    ->click(trans('general.Logout'))
                    ->seePageIs('/auth/login/');
        }


        /**
        * @test
        */
        public function it_try_visit_the_logout_url_when_user_not_login()
        {
            $this->visit('/auth/logout')
                 ->seePageIs('/auth/login/');
        }


}

