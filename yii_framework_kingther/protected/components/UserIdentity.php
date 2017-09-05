<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
       $users = array(
            //'admin' => '0192023a7bbd73250516f069df18b500',
            'dzcozamanis' => 'bd6bf88b3b11b2f9dece982faef42b1a',
        );
		/*if (strpos($this->username,"@")) {
			$users = User::model()->notsafe()->findByAttributes(array('email'=>$this->username));
		 } else {
			 $users = User::model()->notsafe()->findByAttributes(array('username'=>$this->username));
		 }*/
		
        if (!isset($users[$this->username]))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($users[$this->username] !== md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }

}