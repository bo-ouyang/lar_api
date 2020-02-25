<?php

namespace App\Http\Controllers\Mall\v1;


use App\Http\Controllers\Controller;
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
    	$sort  =  $request->get('sort',1)>0?'asc':'desc';
    	$page = $request->get('page',0);
    	//dd($data['goods']=DB::table('goods')->orderBy($order,$sort)->forPage($page,10));
            $data['goods']=DB::table('goods')->orderBy($order,$sort)->forPage($page,10)->get()->each(function ($item,$value){
                //dump($item->goods_image);
                if($item){
                    $item->goods_image = GoodsModel::$IMAGE_BASE_URL.$item->goods_image;
                }
            });
		$data['category']=DB::table('goods_cate')->where(['parent_id'=>0])->get();
		return Response::create($data);
	}
	public function goodsDetail(Request $request){
        $id = $request->post('id');
        if(!$id){
            return $this->error('10002','param error',[]);
        }
        $GoodsDetail = [];
        $GoodsDetail['goods'] = DB::table('goods')->where(['goods_id'=>$id])->first();
        $GoodsDetail['goods']->goods_image = 'http://mall.ouyang.wiki/static/Uploads/temp/'.$GoodsDetail['goods']->goods_image;
       /* $GoodsDetail->type = DB::table('goods_optional')
            ->join('goods_optional_type','goods_optional.type_id','=','goods_optional_type.type_id')
            ->where('goods_optional.goods_id',$id)->distinct()->get();*/
        $GoodsDetail['type'] = DB::table('goods_optional')
            ->join('goods_optional_type','goods_optional.type_id','=','goods_optional_type.type_id')
            ->where('goods_optional.goods_id',$id)
            ->select('goods_optional_type.name','goods_optional_type.type_id')
            ->distinct()->get()->toArray();
        foreach ($GoodsDetail['type'] as $v){
            $GoodsDetail['type_list'] = DB::table('goods_optional')->where(['goods_id'=>$id])->get();
        }


        $GoodsDetail['album'] =  DB::table('goods_album')->where('goods_id',$id)->get('image')->each(function($item,$value){
            return $item->image = GoodsModel::$IMAGE_BASE_URL.$item->image;
        });
        //$GoodsDetail->goods->goods_image = 'http://mall.ouyang.wiki/static/Uploads/temp/'.$GoodsDetail->goods->goods_image;
        $GoodsDetail['goods_review']['content'] = DB::table('goods_review')->where('goods_id',$id)->get();
        $GoodsDetail['goods_review']['counts'] = count($GoodsDetail['goods_review']);
        $GoodsDetail['goods_review']['rate'] = 0;
        return $this->success($GoodsDetail,10000,'success');
      //  return Response::create($GoodsDetail);
    }



}
