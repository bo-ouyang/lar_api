<?php

namespace App\Http\Controllers\Mall\v1;


use App\Http\Controllers\Controller;
use App\Http\Model\GoodsAlbumModel;
use App\Http\Model\GoodsCateModel;
use App\Http\Model\GoodsModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;

class HomeController extends Controller
{
    public function __construct(){

    }
	public function index(){

	}
	public function goods(Request $request){
       // return Response::create(1111);
    	$order = $request->get('order','goods_id');
    	$sort  =  $request->get('sort',1)>0?'desc':'asc';
    	$page = $request->get('page',0);
    	$cid  = $request->get('cid',0);
    	if($cid){
            $data['goods']= GoodsModel::where(['cate_id'=>$cid,'seckill'=>0])->orderBy($order,$sort)->offset(10*$page)->limit(10)->get()->toArray();
        }
        $data['goods']= GoodsModel::where(['seckill'=>0])->orderBy($order,$sort)->offset(10*($page-1))->limit(10)->get()->toArray();
        $data['goodsKill']= GoodsModel::where(['seckill'=>1])->orderBy($order,$sort)->offset(10*($page-1))->limit(10)->get()->toArray();
        $data['activity_image']= [
            'new'=>GoodsModel::$IMAGE_ACTIVITY_URL.'new.png',
            'recommend'=>GoodsModel::$IMAGE_ACTIVITY_URL.'recommend.png',
            'discount'=>GoodsModel::$IMAGE_ACTIVITY_URL.'discount.png'
        ];
		$data['category']=DB::table('goods_cate')->where(['parent_id'=>0])->get();
		return Response::create($data);
	}
	public function goodsDetail(Request $request){
        $id = $request->post('id');
        if(!$id){
            return $this->error('10002','param error',[]);
        }
        $GoodsDetail = [];
        $GoodsDetail['goods'] = GoodsModel::where('goods_id',$id)->first();
        $GoodsDetail['type'] = DB::table('goods_optional')
            ->join('goods_optional_type','goods_optional.type_id','=','goods_optional_type.type_id')
            ->where('goods_optional.goods_id',$id)
            ->select('goods_optional_type.name','goods_optional_type.type_id')
            ->distinct()->get()->toArray();
        foreach ($GoodsDetail['type'] as $v){
            $GoodsDetail['type_list'] = DB::table('goods_optional')->where(['goods_id'=>$id])->get();
        }
        $GoodsDetail['album'] = GoodsAlbumModel::where('goods_id',$id)->get()->toArray();
        $GoodsDetail['album'][]['image'] = $GoodsDetail['goods']->goods_image;
        $GoodsDetail['goods_review']['content'] = DB::table('goods_review')->where('goods_id',$id)->get();
        $GoodsDetail['goods_review']['counts'] = count($GoodsDetail['goods_review']);
        $GoodsDetail['goods_review']['rate'] = 0;
        return $this->success($GoodsDetail,10000,'success');
      //  return Response::create($GoodsDetail);
    }



}
