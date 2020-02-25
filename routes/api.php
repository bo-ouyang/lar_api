<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use \Illuminate\Support\Facades\Route;

Route::get('/test',function (){
	return md5('admin');
});
//Route::get('/mall/home/goods','Mall\v1\HomeController@goods');




Route::namespace('Mall')->prefix('mall')->group(function(){
	Route::namespace('v1')->prefix('v1')->group(function(){
		Route::get('/home/goods','HomeController@goods');
		Route::post('/login','UserController@login');
		Route::post('/auth','UserController@auth');
        Route::post('/register','UserController@register');
		Route::post('/userInfo','UserController@userInfo');
        Route::post('/userAddress','UserController@userAddress');


        Route::post('/home/GoodsDetail','HomeController@GoodsDetail');
        Route::post('/ToCart','UserActionController@ToCart');
        Route::post('/Order','UserActionController@Order');

        Route::post('/CreateOrder','UserActionController@CreateOrder');

        Route::get('/kill','ActivityController@Kill');

        Route::get('/test','ActivityController@test');
	});
});
