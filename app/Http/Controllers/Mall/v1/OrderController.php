<?php
/**
 * Created by PhpStorm.
 * User: oyb
 * Date: 2020/3/5
 * Time: 13:24
 */

namespace App\Http\Controllers\Mall\v1;


use App\Http\Controllers\Controller;
use App\Http\Model\GoodsModel;
use App\Http\Model\GoodsOptionalModel;
use App\http\Model\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    public function orders(Request $request){
        $status = $request->get('status',0);
        $orders = OrderModel::all();
        if(!$status){
            $orders = OrderModel::where('status',$status)->all();
        }

        return $this->success($orders);
    }
    public function CreateOrder(Request $request){
        $param = $request->post();

        $temp  = explode('_',$param['goods_id']);

        //dump($temp);die();

        $goodsId = array_shift($temp);
        // print_r($temp);
        $optionPrice = GoodsOptionalModel::whereIn('id',$temp)->sum('opt_price');
        $data['address'] = DB::table('user_consignee')->where(['user_id'=>$param['user_id'],'is_default'=>1])->first();
        $data['goods']   = GoodsModel::where('goods_id',$goodsId)->first();
        $data['goods']->optionPrice = (double)$optionPrice;
        $data['goods']->totalPrice = (double)($optionPrice+$data['goods']->original_price);
        $bargain_rate = $data['goods']->bargain ? 10-$data['goods']->bargain_rate : 1;
        $data['goods']->discountPrice =(double)($data['goods']->origin_price*$bargain_rate)/10;
        $data['goods']->payPrice = (double)($data['goods']->totalPrice - $data['goods']->discountPrice);
        $data['goods']->shopName = $data['goods']->shop_id ? DB::table('shop')->where('shop_id',$data['goods']->shop_id)->value('shop_name'):'官方自营店';
        $data['option']  = DB::table('goods_optional')->whereIn('id',$temp)->get();
        return  $this->success($data,10000,'返回成功');
    }

    public function finishOrder(Request $request){
        $data = $request->post();
        $orderM = new OrderModel();
        //dd($data);die();
        $ret = OrderModel::insert_data($data,$data['from']);
        if(true !== $ret){
            $this->error('11001',$ret,[]);
        }
        if($data['from']!='cart'){
            $orderM->descStock($data['goods']['goods_id'],$data['goods']['goods_qty']);
        }else{
            foreach ($data['goods'] as $v){
                $ret = $orderM->descStock($v['goods_id'],$v['goods_qty']);
                if(!$ret){
                    return $this->error('11002',$ret);
                }
            }
        }


        //如果订单加入成功 开始减少库存
    }
}