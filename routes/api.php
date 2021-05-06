<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

  //header('Access-Control-Allow-Origin', "http://localhost:8000");
  //header('Access-Control-Allow-Headers', "Accept,Authorization,origin, x-requested-with, Content-type");
  //header('Access-Control-Allow-Methods', "PUT, GET, POST, DELETE, OPTIONS");

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');
Route::post('/number','UserApi@number');



Route::middleware('auth:api')->get('/home','UserApi@UserApi');
Route::middleware('auth:api')->get('/getSubCategory','UserApi@getSubCategory');
Route::middleware('auth:api')->get('/getProducts','UserApi@getProducts');
Route::middleware('auth:api')->get('/getCart','UserApi@getCart');
Route::middleware('auth:api')->get('/getOrder','UserApi@getOrder');
Route::middleware('auth:api')->get('/getBmi','UserApi@getBmi');
Route::middleware('auth:api')->get('/getBmi','UserApi@getBmi');
Route::middleware('auth:api')->get('/getQuestion','UserApi@getQuestion');
Route::middleware('auth:api')->get('/getSbtReport','UserApi@getSbtReport');
Route::middleware('auth:api')->get('/getAppoinment','UserApi@getAppoinment');
Route::middleware('auth:api')->get('/replyAi','UserApi@replyAi');
Route::middleware('auth:api')->get('/basic','UserApi@basicPackage');
Route::middleware('auth:api')->get('/standard','UserApi@standardPackage');
Route::middleware('auth:api')->get('/premium','UserApi@premiumPackage');
Route::middleware('auth:api')->get('/doctorSearchBox','UserApi@doctorSearchBox');
Route::middleware('auth:api')->get('/getFilter','UserApi@getFilter');
Route::middleware('auth:api')->get('/week','UserApi@week');
Route::middleware('auth:api')->get('/month','UserApi@month');
Route::middleware('auth:api')->get('/year','UserApi@year');
Route::middleware('auth:api')->get('/getBlog','UserApi@getBlog');
Route::middleware('auth:api')->get('/getFaq','UserApi@getFaq');
Route::middleware('auth:api')->get('/getEvent','UserApi@getEvent');
Route::middleware('auth:api')->get('/deliveryStatus','UserApi@deliveryStatus');
Route::middleware('auth:api')->get('/otp','UserApi@otp');
Route::middleware('auth:api')->get('/getAllReport','UserApi@getAllReport');




Route::middleware('auth:api')->post('/postCategory','UserApi@postCategory');
Route::middleware('auth:api')->post('/postSubCategory','UserApi@postSubCategory');
Route::middleware('auth:api')->post('/addCart','UserApi@addCart');
Route::middleware('auth:api')->post('/getModel','UserApi@getModel');
Route::middleware('auth:api')->get('/doctors','UserApi@doctors');
Route::middleware('auth:api')->post('/doctorDetail','UserApi@doctorDetail');
Route::middleware('auth:api')->post('/appoinment','UserApi@appoinment');
Route::middleware('auth:api')->post('/bmi','UserApi@bmi');
Route::middleware('auth:api')->post('/orders','UserApi@orders');
Route::middleware('auth:api')->post('/postQuestion','UserApi@postQuestion');
Route::middleware('auth:api')->post('/postAgeAndBmi','UserApi@postAgeAndBmi');
Route::middleware('auth:api')->post('/ai','UserApi@ai');
Route::middleware('auth:api')->post('/activePackage','UserApi@activePackage');
Route::middleware('auth:api')->post('/reOrder','UserApi@reOrder');
Route::middleware('auth:api')->post('/doctorSearchList','UserApi@doctorSearchList');

Route::middleware('auth:api')->post('/postFilter','UserApi@postFilter');
Route::middleware('auth:api')->post('/invoice','UserApi@invoice');
Route::middleware('auth:api')->post('/reAppoinment','UserApi@reAppoinment');
Route::middleware('auth:api')->post('/appoinmentInvoice','UserApi@appoinmentInvoice');
Route::middleware('auth:api')->post('/leaveMessage','UserApi@leaveMessage');
Route::middleware('auth:api')->post('/subscribeEmail','UserApi@subscribeEmail');
Route::middleware('auth:api')->post('/addCalender','UserApi@addCalender');
Route::middleware('auth:api')->post('/addChatBot','UserApi@addChatBot');
Route::middleware('auth:api')->post('/removeNotifi','UserApi@removeNotifi');
