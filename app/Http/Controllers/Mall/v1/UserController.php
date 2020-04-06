<?php


namespace App\Http\Controllers\Mall\v1;


use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Http\Model\OrderModel;
use function Sodium\add;

class UserController extends Controller {

	public function login(Request $request){
		$data = $request->post();
		$user = DB::table('user')->where(['user_login'=>$data['user']])->select('id','user_login','user_pass')->first();
		$token = DB::table('user_token')->where(['user_id'=>$user->id])->value('token');
		if(empty($user)){
			return $this->error(UserException::USER_NOT_EXIST,UserException::$msgList[UserException::USER_NOT_EXIST]);
		}else if(cmf_compare_password($data['pass'],$user->user_pass)){

			return $this->error(UserException::USER_PASS_WRONG,UserException::$msgList[UserException::USER_PASS_WRONG]);
		}else{
			return $this->success(['token'=>$token,'username'=>$user->user_login,'uid'=>$user->id],10000,'success','');
		}
	}
	public function auth(Request $request){
		$data = $request->post();
		if(!empty($data)){
            $user = DB::table('user')->where(['user_login'=>$data['user']])->select('id','user_login')->first();
            $token = DB::table('user_token')->where(['user_id'=>$user->id])->value('token');
            if(empty($user)){
                return $this->error(UserException::USER_NOT_EXIST,UserException::$msgList[UserException::USER_NOT_EXIST]);
            }else{
                return $this->success(['token'=>$token,'username'=>$user->user_login,'uid'=>$user->id],10000,'success','');
            }
        }else{
            return $this->error(UserException::USER_NOT_LOGIN,UserException::$msgList[UserException::USER_NOT_LOGIN]);
        }


	}
	public function register(){

    }
	public function userInfo(Request $request){
        $data = $request->post();
        $data['userInfo'] = DB::table('user')->select('user_login','balance','score','coin')->where(['user_login'=>$data['username']])->first();
        $data['orderStatus'] = Db::table('order')->select(Db::raw(
        ' 	
        (select count("order_status") from verydows_order where order_status = 1) as s1,
		(select count("order_status") from verydows_order where order_status = 2) as s2,
		(select count("order_status") from verydows_order where order_status = 3) as s3,
		(select count("order_status") from verydows_order where order_status = 4) as s4,
		(select count("order_status") from verydows_order where order_status = 5) as s5 '
		))->limit(1)->first();
		//dd($data);die();

        return $this->success($data,10000,'success','');
    }


    public function userAddress(Request $request){
	    $param = $request->post();
	    $address = DB::table('user_consignee')->where('user_id',$param['uid'])->get();

	    return $this->success($address,10000);
    }
}
