<?php namespace Lem\Mailer;

/**
 * Mailer
 **/
abstract class Mailer
{
    /**
     * send a message
     *
     * @param  string  $email
     * @param  string  $subject
     * @param  string  $view
     * @param  array   $data
     * @return void
     */
    public function sendTo($email, $subject, $view, $data=[])
    {
        \Mail::send($view, $data, function($message) use ($email, $subject){
            $message->to($email)
                ->subject($subject);
        });
    }
}
