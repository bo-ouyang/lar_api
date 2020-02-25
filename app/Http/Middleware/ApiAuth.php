<?php


namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ApiAuth {
	public function handle($request,\Closure $next){
			//$token = $request->input('token','');
			/*$userToken = DB::table('users')->where(['token'=>$request->input('token')])->value('token');
			if($token==''){
				return Response::json(['status'=>0,'msg'=>'请登录']);
			}
			if($token!==$userToken){
				return Response::json(['status'=>0,'msg'=>'请重新登录']);
			}*/
			return $next($request);
	}
}

