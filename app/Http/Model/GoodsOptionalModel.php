<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsOptionalModel extends Model
{
    //
    protected $table = 'goods_optional';
    public function GoodsOptionalType(){
        return $this->hasMany('App\Http\Model\GoodsOptionalTypeModel','type_id','type_id');
    }
}
