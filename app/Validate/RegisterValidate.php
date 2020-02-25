<?php


namespace App\Validate;







use Illuminate\Support\Facades\Validator;

class RegisterValidate extends Validate {
			protected $message = '';
			protected $data =[];
			public  function regValidate($data){
				$rule = [
					'username'=>'required|max:255',
					'password'=>'required',
					'email'=>'email'
				];
				$message = [
					'username.required'=>'用户名不能为空',
					'username.max'=>'用户名太长',
					'password.required'=>'密码不能为空',
					'email.email'=>'邮箱格式不正确',
				];
				$validate = Validator::make($data,$rule,$message);
				if($validate->fails()){
					$this->message = $validate->errors()->first();
					return $this->baseFail($this->data,$this->message);
				}
				return $this->baseSuccess($this->data,$this->message);
			}
}