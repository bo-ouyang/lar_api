<?php

namespace App\Http\Controllers\Mall\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
			public function articles(){
				$articles = DB::table('posts')->where(['post_status'=>'publish'])->get();
				dump($articles);
			}

			public function post(){

			}
			public function save(){

			}
			public function del(){

			}
}
