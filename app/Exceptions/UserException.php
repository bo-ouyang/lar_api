<?php


namespace App\Exceptions;


use Illuminate\Foundation\Bootstrap\HandleExceptions;

class UserException {
	const USER_NOT_EXIST = 10001;
	const USER_PASS_WRONG= 10002;
    const USER_NOT_LOGIN = 10003;
    const USER_TOKEN_EXPIRE = 10004;
	public static $msgList = [
	self::USER_NOT_EXIST =>'用户不存在',
	self::USER_PASS_WRONG=>'账号密码错误',
    self::USER_NOT_LOGIN=>'用户未登录1',
        self::USER_TOKEN_EXPIRE=>'请重新登录'
	];
}
