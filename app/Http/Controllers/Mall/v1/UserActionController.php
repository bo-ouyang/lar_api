<?php
/**
 * Created by PhpStorm.
 * User: oyb
 * Date: 2020/2/12
 * Time: 10:47
 */

namespace App\Http\Controllers\Mall\v1;


use App\Http\Controllers\Controller;
use App\Http\Model\GoodsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserActionController extends Controller
{

    public function ToCart(Request $request){
        $data = $request->post();
        $count = count($data['goods_info']);
        $infoStr = $data['goods_info'][0]['goods_id'];

        $qty = DB::table('goods')->where(['goods_id'=>$infoStr])->value('stock_qty');
        if($qty){
            if($count){
                for ($i=0;$i<=$count-1;$i++) {
                    $infoStr .= '_' . $data['goods_info'][$i]['id'];
                }
            }
            $data['goods_info'] = $infoStr;
            $ret = DB::table('user_cart')->where(['user_id'=>$data['user_id'],'goods_info'=>$infoStr])->value('id');
            if($ret){
                return $this->error(10001,'该商品已在购物车');
            }
            $ret = DB::table('user_cart')->insert([$data]);
            if($ret){
               return $this->success([],10000,'加入购物车成功');
            }
        }else{
            return $this->error([],10001,'库存不足');
        }

    }

    public function CreateOrder(Request $request){
        $param = $request->post();

        $temp  = explode('_',$param['goods_id']) ;

        //dump($temp);die();

        $goodsId = array_shift($temp);
       // print_r($temp);
        $data['address'] = DB::table('user_consignee')->where(['user_id'=>$param['user_id'],'is_default'=>1])->first();
        $data['goods']   = DB::table('goods')->where('goods_id',$goodsId)->first();
        $data['goods']->goods_image = GoodsModel::$IMAGE_BASE_URL.$data['goods']->goods_image;
        $data['option']  = DB::table('goods_optional')->whereIn('id',$temp)->get();
       return  $this->success($data,10000,'返回成功');
    }

    public function Order(Request $request){
        $data = $request->post();
    }
    public function Tofavorite(){

    }
}