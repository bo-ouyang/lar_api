<?php
/**
 * Created by PhpStorm.
 * User: oyb
 * Date: 2020/2/12
 * Time: 10:53
 */

namespace App\Http\Controllers\Mall\v1;


use App\Http\Controllers\Controller;
use App\Http\Model\UserModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


class ActivityController extends Controller
{


    public function killGoodsInfo(Request $request){
       $goodsId = $request->get('goods_id',1);
       $goodsStock = DB::table('goods')->where(['goods_id'=>$goodsId])->value('stock_qty');
       $redisStockLeft = Redis::llen('stock_left');
       $left = $goodsStock - $redisStockLeft;
       for ($i=0;$i<$left;$i++){
           Redis::lpush('goods_stock'.$goodsId,$goodsId);
       }
    }
    public function killWatch(){
       // Redis::rpush('test_list',111);
        $ret = DB::table('goods')->where(['goods_id'=>2])->first()->stock_qty;
        if($ret){
            $order = [
                'user_id'=>1,
                'order_sn'=>'sssss',
                'order_id'=>time(),
            ];
            $oid = DB::table('order')->insertGetId($order);
            $dec = DB::table('goods')->where(['goods_id'=>2])->decrement('stock_qty',1);
            $orderGoods= [
                'order_id'=>$oid,
                'goods_id'=>2,
                'goods_qty'=>1
            ];
            $ogret = DB::table('order_goods')->insert($orderGoods);
            if($oid>0&&$dec>0&&$ogret>0){

                return '抢购成功';
            }
        }
       // print_r(Redis::lrange('test_list',0,-1));
        //$is_in = Redis::sismember('test_list',111);
       // var_dump($is_in);
      /*  $stock = 20;
       // $redis = new Redis::();
        $stock_left = Redis::get('stock_left');
        if($stock>$stock_left){
            Redis::watch('stock_left');
            Redis::multi();
            Redis::incr('stock_left');
            Redis::exec();

            echo 'redis->get()数量:'.Redis::get('stock_left');

        }else{
            echo '库存为'.$stock_left;
        }*/
    }

    public function Kill(Request $request){

        /**
         *  1 把用户加入redis 队列
         */
        //$data = $request->only(['uid','goods_id']);
        $data['uid'] = random_int(1,500);
        $data['goods_id'] =1;
        Redis::rpush('user_list',$data['uid']);
        $count = Redis::lpop('goods_stock'.$data['goods_id']);
        if($count){
            $uid = Redis::lpop('user_list');
            DB::beginTransaction();
             $ret = DB::table('goods')->where(['goods_id'=>$data['goods_id']])->lockForUpdate()->first()->stock_qty;
                if($ret){
                    $order = [
                      'user_id'=>$uid,
                      'order_sn'=>'sssss',
                      'order_id'=>time(),

                    ];
                    $oid = DB::table('order')->insertGetId($order);
                    $dec = DB::table('goods')->where(['goods_id'=>$data['goods_id']])->decrement('stock_qty',1);
                    $orderGoods= [
                        'order_id'=>$oid,
                        'goods_id'=>$data['goods_id'],
                        'goods_qty'=>1
                    ];
                     $ogret = DB::table('order_goods')->insert($orderGoods);
                     if($oid>0&&$dec>0&&$ogret>0){
                         DB::commit();
                         return '抢购成功';
                     }
                }
        }else{
            echo  'out';
        }
    }



    public function test(){
        /*$user = UserModel::find(1);
        $user->coin = 10;
        $user->fresh();
        $user->save();*/

        UserModel::create(['user_login'=>'test','user_nickname'=>'guardTets']);
    }

}