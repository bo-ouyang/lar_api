<?php

namespace App\http\Model;
use App\Http\Model\GoodsModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    protected $table = 'order';
    public static $OrderStatus = [
        -1 => '退款成功',
        0 => '未支付',
        1 => '已支付',
        2 => '待发货',
        3 => '已发货',
        4 => '待收货',
        5 => '待评价',
        6 => '已完成'
    ];
    public static $payment = [
        1 => '余额支付',
        2 => '支付宝支付',
        3 => '微信支付',
        4 => '银行卡支付'
    ];
    public static $shipping = [
        1 => '顺丰',
        2 => '中通',
        3 => '韵达',
    ];
    public static $expire_time = 15 * 3600;

    public function OrderGoods()
    {
        return $this->hasMany('OrderGoods');
    }

    /**
     * @param $data 订单信息
     * @param string $from 直接结算 / 购物车结算
     * @return array
     */
    public static function insert_data($data,$from='default')
    {

        if($from !=='cart') {

            $order_sn = get_order_sn();
            $order_info = $data['order_info'];
            //print_r($data['order']);
           // die();
            $order = [
                'order_sn' => $order_sn,
                'user_id' => $order_info['user_id'],
                'payment_method' => 0,
                'shipping_method' => 0,
                'goods_amount' => $order_info['goods_amount'],
                'shipping_amount' => 0,
                'order_amount' => $order_info['order_amount'],
                'memos' => $order_info['memos'],
                'created_date' => time(),
                'payment_date' => 0,
                'expired_date' => time() + self::$expire_time,
                'discount_amount' => number_format($order_info['discount_amount'],2),
                'shop_id' => $order_info['shop_id']
            ];
            $goods = $data['goods'] ;
                //$goods = GoodsModel::where('goods_id',$goods_id)->first();

                $orderGoods = [
                    'order_sn' => $order_sn,
                    'goods_id' => $goods['goods_id'],
                    'goods_name' => $goods['goods_name'],
                        'goods_image' => $goods['goods_image'],
                    'goods_price' => $goods['original_price'],
                    'discount_price' => $goods['discount_price'],
                    'goods_optional' => $goods['goods_optional'],
                    'goods_optional_price' => $goods['goods_optional_price'],
                    'goods_qty' => $goods['goods_qty']
                ];

            DB::beginTransaction();
            $ret = DB::table('order')->insert($order);
            if ($ret) {
                $ret = Db::table('order_goods')->insert($orderGoods);
                if ($ret) {
                    DB::commit();
                    return ['status' => true, 'msg' => '订单创建成功'];
                }else{
                    DB::rollBack();
                    return ['status' => false, 'msg' => '订单商品加入失败'];
                }
            }else{
                DB::rollBack();
                return ['status' => false, 'msg' => '订单加入失败'];
            }


        }
    }

    public function descStock($goods_id,$goods_qty){
        DB::beginTransaction();
        $ret = DB::table('goods')->decrement('stock_qty',$goods_qty);
    }

    public function deleteExpireOrder()
    {

    }


}
