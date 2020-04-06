<?php
/**
 * CMF密码比较方法,所有涉及密码比较的地方都用这个方法
 * @param string $password     要比较的密码
 * @param string $passwordInDb 数据库保存的已经加密过的密码
 * @return boolean 密码相同，返回true
 */
function cmf_compare_password($password, $passwordInDb)
{
	if (strpos($passwordInDb, "###") === 0) {
		return cmf_password($password) == $passwordInDb;
	} else {
		return cmf_password_old($password) == $passwordInDb;
	}
}
/**
 * CMF密码加密方法
 * @param string $pw       要加密的原始密码
 * @param string $authCode 加密字符串
 * @return string
 */
function cmf_password($pw, $authCode = '')
{
	if (empty($authCode)) {
		$authCode = config('database.authcode');
	}
	$result = "###" . md5(md5($authCode . $pw));
	return $result;
}

/**
 * CMF密码加密方法 (X2.0.0以前的方法)
 * @param string $pw 要加密的原始密码
 * @return string
 */
function cmf_password_old($pw)
{
	$decor = md5(config('database.prefix'));
	$mi    = md5($pw);
	return substr($decor, 0, 12) . $mi . substr($decor, -4, 4);
}

/**
 * 获取惟一订单号
 * @return string
 */
function get_order_sn()
{
    return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}
/**
 * 检查手机或邮箱是否还可以发送验证码,并返回生成的验证码
 * @param string  $account 手机或邮箱
 * @param integer $length  验证码位数,支持4,6,8
 * @return string 数字验证码
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException
 */
function cmf_get_verification_code($account, $length = 6)
{
    if (empty($account)) return false;
    $verificationCodeQuery = Db::name('verification_code');
    $currentTime           = time();
    $maxCount              = 5;
    $findVerificationCode  = $verificationCodeQuery->where('account', $account)->find();
    $result                = false;
    if (empty($findVerificationCode)) {
        $result = true;
    } else {
        $sendTime       = $findVerificationCode['send_time'];
        $todayStartTime = strtotime(date('Y-m-d', $currentTime));
        if ($sendTime < $todayStartTime) {
            $result = true;
        } else if ($findVerificationCode['count'] < $maxCount) {
            $result = true;
        }
    }

    if ($result) {
        switch ($length) {
            case 4:
                $result = rand(1000, 9999);
                break;
            case 6:
                $result = rand(100000, 999999);
                break;
            case 8:
                $result = rand(10000000, 99999999);
                break;
            default:
                $result = rand(100000, 999999);
        }
    }

    return $result;
}

/**
 * 字符串转数组
 * @deprecated
 * @param string $string 字符串
 * @return array
 */
function str_to_arr($string)
{
    $result = is_string($string) ? explode(',', $string) : $string;
    return $result;
}
