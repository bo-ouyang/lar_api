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
use Illuminate\Support\Facades\Redis;

class ActivityController extends Controller
{

    public function Kill(){
        Redis::set('key','value');
        $value = Redis::get('key');
        dd($value);
    }

    public function test(){
        /*$user = UserModel::find(1);
        $user->coin = 10;
        $user->fresh();
        $user->save();*/

        UserModel::create(['user_login'=>'test','user_nickname'=>'guardTets']);
    }

}