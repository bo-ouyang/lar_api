<?php
/**
 * Created by PhpStorm.
 * User: oyb
 * Date: 2020/3/5
 * Time: 13:13
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class GoodsAlbumModel extends Model
{
    protected $table = 'goods_album';

    public function getImageAttribute($value){
return GoodsModel::$IMAGE_BASE_URL.$value;
    }
}