<?php
/**
 * Created by PhpStorm.
 * User: oyb
 * Date: 2020/3/5
 * Time: 11:49
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class GoodsCateModel extends Model
{
        protected $table = 'goods_cate';
        public function goods(){
            return $this->hasMany('App\Http\Model\GoodsModel','cate_id','cate_id');
        }
}