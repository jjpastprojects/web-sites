<?php

 namespace Lembarek\Mailer;

/**
 * User Mailer
 **/

class UserMailer extends Mailer
{
    /**
     * to send welcome message to a user
     *
     * @param  string  $to
     * @return mixed
     */
    public function welcome($to)
    {
        $subject = trans('mailer::mail.welcome');
        $view = 'mailer::emails.welcome';
        return $this->sendTo($to, $subject, $view);
    }

    /**
     * to send a message to reset user password
     *
     * @param  string  $data
     * @return mixed
     */
    public function sendResetPasswordEmailTo($data)
    {
        $subject = trans('mailer::mail.reset_password');
        $view = 'mailer::emails.resetPassword';
        return $this->sendTo($data['email'], $subject, $view, $data);
    }


}
