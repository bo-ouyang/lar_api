<?php
/**
 * Created by PhpStorm.
 * User: oyb
 * Date: 2020/3/5
 * Time: 11:17
 */

namespace App\Http\Controllers\Mall\v1;


use App\Http\Controllers\Controller;
use App\Http\Model\GoodsCateModel;
use App\Http\Model\GoodsModel;
use App\Http\Model\GoodsOptionalModel;
use Illuminate\Http\Request;


class GoodsController extends Controller
{
    public function ListByCateId(Request $request){
        $cid = $request->get('cid');
        if($cid){
            $this->error(10001,'参数错误');
        }
        //$list = GoodsCateModel::where(['cate_id'=>$cid])->first()->goods->toArray();
        $list = GoodsOptionalModel::where(['goods_id'=>$cid])->first()->GoodsOptionalType->toArray();
        //$list = GoodsModel::orderBy('goods_id','desc')->offset(10)->limit(10)->get()->toArray();
        print_r($list);
        //return $this->success($list,200);
    }
}