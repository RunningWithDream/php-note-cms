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


Route::get('/','admin/Gate/login');
Route::get('login','admin/Gate/login');
Route::get('index','admin/Home/index');
Route::get('welcome','admin/Home/welcome');


Route::get('admin-list','admin/Admin/index');
Route::get('admin-add','admin/Admin/create');
Route::get('admin-edit','admin/Admin/edit');
Route::post('admin-save','admin/Admin/save');


Route::get('admin-role','admin/Role/index');
Route::get('role-add','admin/Role/create');






//Route::resource('news','index/news')->vars(['news' => 'news_id']);
//Route::resource('category','index/category')->vars(['category' => 'category_id']);


//test - need-delete
//Route::get('index','index/Home/index');
//Route::get('admin','index/Home/admin');
//Route::get('page','index/Home/page');
//Route::get('test','index/Home/test');
//Route::get('get','index/Home/get');