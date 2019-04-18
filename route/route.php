<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('/','admin/Home/index');
Route::get('admin','admin/Home/admin');
Route::get('page','admin/Home/page');
Route::get('test','admin/Home/test');
Route::get('get','admin/Home/get');


Route::resource('news','index/news')->vars(['news' => 'news_id']);
Route::resource('category','index/category')->vars(['category' => 'category_id']);



Route::resource('message','index/message');
Route::get('message/page','@message/page');

Route::group('api',function (){
    Route::get('encode','@Api/encode');
    Route::get('decode','@Api/decode');
    Route::get('detest','@Api/detest');
})->middleware('login');


//Route::get('index','@Index/index');

//Route::get('login','@Index/login');
Route::get('bus','@Index/bus');

Route::post('tologin','@Index/tologin');
Route::post('tobus','@Index/tobus');



Route::get('login','admin/Gate/login');
Route::group(['middleware'=>['login']],function(){
    Route::get('tologin','admin/Gate/tologin')->middleware('vlogin');
    Route::get('home','admin/home/index');
});






return [

];
