<?php

namespace app\common\service;

use think\Db;

use think\facade\Cache;

use Firebase\JWT\JWT;

use think\facade\Config;

class OperationToken

{

 public static function createToken(int $uid, string $uuid, int $is_ban): array

 {

	 $time = time();

	 $info_token = [

		 'iat' => $time,//签发时间

		 'voe' => Config::get('TOKEN_VOE',7200) + $time,//换取有效时间

		 'exp' => Config::get('TOKEN_EXP',3600)+$time,//有效时间

		 'sign' => base64_encode($uuid),//签名

		 'data' => [

		 'uid' => $uid,//用户id

		 'is_ban' => $is_ban,//是否被禁用

		 ]

	 ];

	 $token = JWT::encode($info_token, Config::get('JWT_KEY'));

	 Cache::tag('login')->set('token_' . $uid, $token, Config::get('TOKEN_VOE',7200) + $time);

	 Db::name('bdr_kh_user_login_log')->insert(

		 [

			 'uid'=>$uid,

			 'token'=>$token,

			 'iat_time'=>$time,

			 'ip'=>ip2long(request()->ip()),

			 'exp_time'=>Config::get('TOKEN_EXP',3600)+$time,

			 'voe_time'=> Config::get('TOKEN_VOE',7200) + $time

		 ]

	 );

	 return ['token'=>$token, 'voe' =>Config::get('TOKEN_VOE',7200) + $time,'exp' => Config::get('TOKEN_EXP',3600)+$time];

	 }

}