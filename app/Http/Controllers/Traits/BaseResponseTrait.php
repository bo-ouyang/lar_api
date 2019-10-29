<?php


namespace App\Http\Controllers\Traits;


Trait BaseResponseTrait {
		public function respond($data,$message,$status){
			return ['data'=>$data,'message'=>$message,'status'=>$status];
		}
		public function baseSuccess($data=[],$message='Request Success',$status='y'){
			return $this->respond($data,$message,$status);
		}
		public function baseFail($data=[],$message='Request Fail',$status='n'){
			return $this->respond($data,$message,$status);
		}
}