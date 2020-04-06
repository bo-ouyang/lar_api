<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model {
		protected $table = 'goods';
		protected $primaryKey='goods_id';


		public function GoodsOptional(){
                return $this->hasMany('APP\Http\Model\GoodsOptionalModel','goods_id','goods_id');
        }



		public static $IMAGE_BASE_URL = 'http://mall.ouyang.wiki/static/Uploads/temp/';
        public static $IMAGE_ACTIVITY_URL = 'http://mall.ouyang.wiki/static/Uploads/activity/';
		/*protected $casts =[
			'goods_image'=>'array'
		];*/
		public function getGoodsImageAttribute($value){
                return self::$IMAGE_BASE_URL.$value;
		}
		/*public function setGoodsImageAttribute($value){
		return json_decode($value,true);
		}*/
}