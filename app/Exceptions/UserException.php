<?php


namespace App\Exceptions;


use Illuminate\Foundation\Bootstrap\HandleExceptions;

class UserException {
	const USER_NOT_EXIST = 10001;
	const USER_PASS_WRONG= 10002;

	public static $msgList = [
	self::USER_NOT_EXIST =>'用户不存在',
	self::USER_PASS_WRONG=>'账号密码错误'
	];
}
