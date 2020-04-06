<?php
/**
 * Created by PhpStorm.
 * User: oyb
 * Date: 2020/2/12
 * Time: 10:50
 */

namespace App\Http\Controllers\Mall\v1;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lib\alipay\aop\AopClient;
use Lib\alipay\aop\request\AlipayTradeAppPayRequest;
use Yansongda\Pay\Pay;

class PayController extends Controller
{



        public function alipay(Request $request){
            $conf = config('Alipay');
            //$alipay = new Pay($conf);

            $config_biz = [
                'out_trade_no' => time(),
                'total_amount' => '0.1',
                'subject'      => 'test subject',
            ];
           return Pay::alipay($conf)->app($config_biz);
           // $alipay->driver('alipay')->getway()->pay($config_biz);
          /*  $order = $request->post();
            $conf = config('alipay');
            $ali = new AopClient();
            $ali->appId = $conf['app_id'];
            $ali->gatewayUrl = $conf['gatewayUrl'];
            $ali->rsaPrivateKey = $conf['merchant_private_key'];
            $ali->alipayrsaPublicKey = $conf['alipay_public_key'];*/





            $alirequest = new AlipayTradeAppPayRequest();
        }
        public function Alinotify(Request $request){
            $conf = config('alipay');
            $pay = new Pay($conf);

            if ($pay->driver('alipay')->gateway()->verify($request->all())) {
                file_put_contents(storage_path('notify.txt'), "收到来自支付宝的异步通知\r\n", FILE_APPEND);
                file_put_contents(storage_path('notify.txt'), '订单号：' . $request->out_trade_no . "\r\n", FILE_APPEND);
                file_put_contents(storage_path('notify.txt'), '订单金额：' . $request->total_amount . "\r\n\r\n", FILE_APPEND);
            } else {
                file_put_contents(storage_path('notify.txt'), "收到异步通知\r\n", FILE_APPEND);
            }

            echo "success";
        }

        public function Alireturns(){

        }
}