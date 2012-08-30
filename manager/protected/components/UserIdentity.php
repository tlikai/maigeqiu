<?php

class UserIdentity extends CUserIdentity
{
	public function authenticate()
	{
		$users=array(
			'wubaiqing'=>'Wu21!q!ng',
            'likai' => '8120043',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}