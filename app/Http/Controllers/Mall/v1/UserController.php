<?php


namespace App\Http\Controllers\Mall\v1;


use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

	public function login(Request $request){
		$data = $request->post();
		$user = DB::table('user')->where(['user_login'=>$data['user']])->select('id','user_login','user_pass')->first();
		$token = DB::table('user_token')->where(['user_id'=>$user->id])->value('token');
		if(empty($user)){
			return $this->error(UserException::USER_NOT_EXIST,UserException::$msgList[UserException::USER_NOT_EXIST]);
		}else if(md5($data['pass'])!=$user->user_pass){
			return $this->error(UserException::USER_PASS_WRONG,UserException::$msgList[UserException::USER_PASS_WRONG]);
		}else{
			return $this->success(['token'=>$token],10000,'success');
		}
	}
}
