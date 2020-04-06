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



    public function Tofavorite(){

    }
}