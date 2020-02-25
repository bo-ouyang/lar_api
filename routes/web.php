<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\DB;
/*
Route::get('/','home\IndexController@index');
Route::get('/category','home\IndexController@category');
Route::get('/login',function (){
	return view('home.login');
});
Route::post('/logining','home\LoginController@logining');

Route::get('/register',function (){
	return view('home.register');
});
Route::post('/reg','home\LoginController@register');

Route::post('/emailExist',function (){
	$mail = \request()->post('param');
	$name= \request()->post('name');

	$uid = DB::table('user')->where([$name=>$mail])->value('user_id');
	//echo $mail.$uid;
	return $uid==null?['info'=>'邮箱可以使用','status'=>'y']:['info'=>'该邮箱已被使用','status'=>'n'];
});*/

/*
Route::middleware('CheckLogin')->group(function (){

});

Route::middleware()->namespace('Admin')->group(function (){

});*/
