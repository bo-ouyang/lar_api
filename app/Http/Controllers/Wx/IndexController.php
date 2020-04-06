<?php
/**
 * Created by PhpStorm.
 * User: oyb
 * Date: 2020/3/11
 * Time: 15:37
 */

namespace App\Http\Controllers\Wx;


use App\Http\Controllers\Controller;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Factory;

class IndexController extends Controller
{


    public function server(Request $request){

        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account.test');
        $app->server->push(function($message){
            switch ($message['MsgType']) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });

        return $app->server->serve();
    }
    public function getMenu(){
        $app = app('wechat.official_account.test');
        $list = $app->menu->list();

    }
    public function setMenu(){
        $app = app('wechat.official_account.test');
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"

                    ],
                ],
            ],
        ];
        $ret = $app->menu->create($buttons);
        dd($ret);
    }
    public function setTempMsg(){

    }
}