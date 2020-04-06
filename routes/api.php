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


Route::get('/binds',function (){
   ;
});


Route::namespace('Mall')->prefix('mall')->group(function(){
    Route::namespace('v1')->prefix('v1')->group(function(){
        Route::get('/home/goods','HomeController@goods');
        Route::get('/goods/ListByCateId','GoodsController@ListByCateId');



        Route::post('/login','UserController@login');
        Route::post('/auth','UserController@auth');
        Route::post('/register','UserController@register');
        Route::post('/home/GoodsDetail','HomeController@GoodsDetail');


        Route::post('/Alinotify','PayController@Alinotify');
        Route::post('/Alireturns','PayController@Alireturns');
        Route::any('/alipay','PayController@alipay');


   Route::get('/kill','ActivityController@Kill');
        Route::get('/killWatch','ActivityController@killWatch');
        Route::get('/killGoodsInfo','ActivityController@killGoodsInfo');
        Route::get('/test','ActivityController@test');


    });
});



Route::namespace('Mall')->prefix('mall')->group(function(){
	Route::namespace('v1')->prefix('v1')->middleware('ApiAuth')->group(function(){

		Route::post('/userInfo','UserController@userInfo');
        Route::post('/userAddress','UserController@userAddress');


        Route::post('/cart/ToCart','UserActionController@ToCart');
        Route::post('/cart/clearCart','UserActionController@clearCart');
        Route::post('/cart/Cart','UserActionController@Cart');

        Route::post('/order/orders','OrderController@Order');
        Route::post('/order/CreateOrder','OrderController@CreateOrder');
        Route::post('/order/finishOrder','OrderController@finishOrder');
     





	});
});

Route::namespace('Wx')->prefix('wx')->middleware('api')->group(function (){


    Route::any('/wxAuthCallBack','WxLoginController@wxAuthCallBack');


    /*Route::middleware('wechat.oauth')->group(function (){
        Route::any('/test','WxLoginController@test');
        Route::any('/friend','WxLoginController@friend');
    });*/

        Route::any('/test','WxLoginController@test');
        Route::any('/friend','WxLoginController@friend');
        Route::any('/server','IndexController@server');

        Route::any('/setMenu','IndexController@setMenu');
        Route::any('/getMenu','IndexController@getMenu');
        Route::any('/getTempMsg','IndexController@getTempMsg');
        Route::any('/setTempMsg','IndexController@setTempMsg');






        //->middleware('');
});

Route::apiResource('/usertest','Mall\v1\usertestController');


