<?php

namespace Lembarek\Auth\Controllers;

use Lembarek\Mailer\UserMailer;
use Lembarek\Auth\Repositories\ResetPasswordRepositoryInterface;
use Illuminate\Http\Request;
use Lembarek\Auth\Repositories\UserRepositoryInterface;

class PasswordController extends Controller
{
    protected $resetPasswordRepo;

    protected $userRepo;

    public function __construct(ResetPasswordRepositoryInterface $resetPasswordRepo, UserRepositoryInterface $userRepo)
    {
        $this->middleware('guest');
        $this->resetPasswordRepo = $resetPasswordRepo;
        $this->userRepo = $userRepo;
    }


    /**
     * show the email to send the informatio to reset the password
     *
     * @return Response
     */
    public function showEmail()
    {
        return view('auth::reset.showEmail');
    }


    /**
     * send a message to the email of the user
     *
     * @return Reponse
     */
    public function sendToEmail(Request $request, UserMailer $userMailer)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $request = $request->only('email');
        $request['token'] = str_random(40);
        $this->resetPasswordRepo->create($request);
        $userMailer->sendResetPasswordEmailTo($request);
        return redirect()->route('core::home');
    }


    /**
     * show the password field that allow the use to reset password
     *
     * @param  string  $token
     * @return Response
     */
    public function showPasswordField($token)
    {
        return view('auth::reset.showPasswordField', compact('token'));
    }

    /**
     * to save then new password
     *
     * @return Response
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'token'    => 'required'
       ]);

        $record= $this->resetPasswordRepo->where('token', $request['token']);
        $email = $record->first()->email;
        $record->delete();

        $user = $this->userRepo->where('email', $email)->update(['password' => $request['password']]);
        return redirect()->route('core::home');
    }
}
