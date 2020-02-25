<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model {
		protected $table = 'goods';
		protected $primaryKey='goods_id';

		public static $IMAGE_BASE_URL = 'http://mall.ouyang.wiki/static/Uploads/temp/';
		/*protected $casts =[
			'goods_image'=>'array'
		];*/
		public function getGoodsImageAttribute($value){

		}
		/*public function setGoodsImageAttribute($value){
		return json_decode($value,true);
		}*/
}