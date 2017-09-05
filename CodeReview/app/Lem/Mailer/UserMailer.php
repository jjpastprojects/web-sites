<?php namespace Lem\Mailer;

/**
 * User Mailer
 **/
class UserMailer extends Mailer
{
    /**
     * to send welcome message to a user
     *
     * @param  string  $
     * @return mixed
     */
    public function welcome()
    {
       $to = 'a@a.a';
       $subject = "welcome email";
       $view = 'emails.welcome';
       $this->sendTo($to, $subject, $view);
    }
}
