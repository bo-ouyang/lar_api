<?php


namespace App\Http\Middleware;
use App\Exceptions\UserException;
use App\Http\Controllers\Traits\BaseResponseTrait;
use App\Http\Model\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ApiAuth {
    use BaseResponseTrait;
	public function handle($request,\Closure $next){
			$token = $request->header('token','');
			if($token==''){
				return $this->error(UserException::USER_NOT_LOGIN,UserException::$msgList[UserException::USER_NOT_LOGIN],[]);
			}
            $userToken = DB::table('user_token')->where(['token'=>$token])->first();
			if(!isset($userToken->token)){
                return $this->error(UserException::USER_TOKEN_EXPIRE,UserException::$msgList[UserException::USER_TOKEN_EXPIRE],[]);
			}
			if($userToken->expire_time < time()){
                return $this->error(UserException::USER_TOKEN_EXPIRE,UserException::$msgList[UserException::USER_TOKEN_EXPIRE],[]);
            }
			return $next($request);
	}
}

