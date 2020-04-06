<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/12
 * Time: 10:57
 */

namespace App\Http\Controllers\Wx;


use App\Http\Controllers\Controller;

use EasyWeChat\Factory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class WxLoginController extends Controller
{
    private $user;
    private $auth;

    /*public function __construct(Request $request)
    {
        $conf = config('wechat.official_account.test');
        // dd($conf);
        $app = Factory::officialAccount($conf);
        $this->auth = $app->oauth;

        if (empty(session('wechat_user'))) {
            return  $this->auth->redirect()->send();
            // header('location:'.'https://'.$request->getHost().'/api/wx/wxAuthCallBack');
        } else {
            $this->user = session('wechat_user');
        }
    }*/


    public function wxAuthCallBack(Request $request)
    {
        if($request->get('code')) {
            $conf = config('wechat.official_account.test');
            $app = Factory::officialAccount($conf);
            $oauth = $app->oauth;
            $user = $oauth->user();
            session(['wechat_user' => is_null($user)? []:$user->toArray()]);
            //var_dump(empty(session('wechat_user')));
           // dd($request);
            if (!empty(session('wechat_user'))) {
                $user = $user->toArray();
                $data = [
                    'open_id' => $user['id'],
                    'nickname' => $user['nickname'],
                    'avatar' => $user['avatar']
                ];
                //$targetUrl = session('target_url') ? '/' : session('target_url');
                $is_in = DB::table('user_wx')->where('open_id', $user['id'])->first();
                if (!$is_in) {
                    $ret = DB::table('user_wx')->insert($data);
                }
                header('location:' .'https://api.ouyang.wiki/api/wx/test');
            }
        }else {
            $conf = config('wechat.official_account.test');
            $app = Factory::officialAccount($conf);
            $oauth = $app->oauth;
            return $oauth->redirect()->send();
        }


    }

    public function friend()
    {
        $conf = config('wechat.official_account.test');
        // dd($conf);
        $app = Factory::officialAccount($conf);
        dd($this->user);
    }

    public function test()
    {
        $user = [];
        $conf = config('wechat.official_account.test');
        // dd($conf);
        $app = Factory::officialAccount($conf);
        $oauth = $app->oauth;
        session('target_url', 'https://api.ouyang.wiki/api/wx/test');
        if (empty(session('wechat_user'))) {
            return $oauth->redirect()->send();
            // header('location:'.'https://'.$request->getHost().'/api/wx/wxAuthCallBack');
        } else {
            $user = session('wechat_user');
        }
        dd($user);
    }
}