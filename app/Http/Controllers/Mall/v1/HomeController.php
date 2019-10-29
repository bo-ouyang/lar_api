<?php

namespace App\Http\Controllers\Mall\v1;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function __construct(){

    }
	public function index(){

	}
	public function goods(Request $request){
    	$order = $request->get('order','goods_id');
    	$sort  =  $request->get('sort',1)>0?'asc':'desc';
		$data['goods']=DB::table('goods')->orderBy($order,$sort)->get();
		$data['category']=DB::table('goods_cate')->where(['parent_id'=>0])->get();
		return Response::create($data);
	}

	public function login(Request $request){
		echo $request->input('token');
	}

}
