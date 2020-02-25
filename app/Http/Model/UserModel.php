<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class UserModel extends Model {
		protected $table = 'user';
		protected $dateFormat = 'U';
		public $timestamps =false;

		protected $guarded = ['user_login'];
}
