<?php

use Illuminate\Support\Facades\Route;

  //header('Access-Control-Allow-Origin', "http://localhost:8000");
  //header('Access-Control-Allow-Headers', "Accept,Authorization,origin, x-requested-with, Content-type");
  //header('Access-Control-Allow-Methods', "PUT, GET, POST, DELETE, OPTIONS");

/*|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cc', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getProduct', 'AdminController@getProduct')->name('getProduct');
Route::get('/getCategory', 'AdminController@getCategory')->name('getCategory');
Route::get('/getSubCategory', 'AdminController@getSubCategory')->name('getSubCategory');
Route::get('/listProduct', 'AdminController@listProduct')->name('listProduct');
Route::get('/doctor', 'AdminController@doctor')->name('listProduct');
Route::get('/consult', 'AdminController@consult')->name('listProduct');
Route::get('/question', 'AdminController@getQuestion')->name('getQuestion');
Route::get('/chatbotQ', 'AdminController@chatbotQ')->name('chatbotQ');
Route::get('/testchatbot', 'AdminController@testchatbot')->name('chatbotQ');
Route::get('/package', 'AdminController@package')->name('package');
Route::get('/blog', 'AdminController@blog')->name('BLOG ADD');
Route::get('/faq', 'AdminController@faq')->name('FAQ ADD');




Route::post('/postProduct', 'AdminController@postProduct')->name('postProduct');
Route::post('/postCategory', 'UserApi@postCategory')->name('postCategory');
Route::post('/postSubCategory', 'UserApi@postSubCategory')->name('postSubCategory');
Route::post('/question', 'AdminController@question')->name('question');
Route::post('/postDoctor', 'AdminController@postDoctor')->name('postDoctor');
Route::post('/aiChat', 'AdminController@aiChat')->name('aiChat');
Route::post('/message','AdminController@message')->name('Message');
Route::post('/addPackage','AdminController@addPackage')->name('Message');
Route::post('/addPost','AdminController@addPost')->name('ADD BLOG POST');
Route::post('/addFaq','AdminController@addFaq')->name('ADD FAQ POST');
Route::post('/updateImage','AdminController@updateImage')->name('ADD Update Image POST');
