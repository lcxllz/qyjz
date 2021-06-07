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

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
Route::get('admin','admin/admin/login');



return [

];


use app\api\validate\Login;
use think\Facade\Route;
use app\http\middleware\Auth;

// Route::get('/','index/Index/index');

// Route::post('login','api/bj.login/login');


Route::post('kh','api/bj.user/index')->middleware(app\http\middleware\Auth::class);



Route::group('api/kh',function (){

  Route::post('/login','api/kh.login/login')->validate('app\api\validate\Login','login');
});




// //需要验证登录

// Route::group('api/kh',function (){

//  Route::get('/user','api/kh.user/index');

// })->middleware(app\http\middleware\Auth::class);

