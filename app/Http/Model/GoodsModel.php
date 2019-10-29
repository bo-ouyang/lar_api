<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model {
		protected $table = 'goods';
		protected $primaryKey='goods_id';
		protected $casts =[
			'goods_image'=>'array'
		];
		public function getGoodsImageAttribute($value){
			if($value!=''){
				echo 111;
				dump($value);
			}else{
				echo 22;
			}
			return json_decode($value,true);
		}
		public function setGoodsImageAttribute($value){
		return json_decode($value,true);
		}
}