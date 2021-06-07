<?php

namespace app\http\middleware;

use Firebase\JWT\JWT;

use Firebase\JWT\SignatureInvalid\Exception;

use think\exception\TokenException;

use think\exception\ValidateException;

use think\facade\Cache;

use think\facade\Config;

class Auth

{

	 public function handle($request, Closure $next)

	 {
	 	dump("111111");die;

		 $bearer_token = [];

		 $bearer = $request->header('authorization');//取header中的token

	 if ($bearer !== null) {

		 //不空尝试去匹配

		 preg_match('/bearers*(S+)/i', $bearer, $bearer_token);

	 }

	 if (empty($bearer_token[1])) {

		 //匹配不到结果尝试去url中获取

		 if ($request->param('token') !== null) {

			 $token = $request->param('token');

		 }else{

			 throw new TokenException('请登录', 401);

		 }

	 }else{

		 $token=$bearer_token[1];

	 }

	 try {

		 $de_token = JWT::decode($token, Config::get('JWT_KEY'), Config::get('JWT_ENCRYPTION'));

	 } catch (SignatureInvalidException $exception) {

		 //捕获JWT解析错误

		 throw new TokenException('无效令牌', 401);

	 } catch (Exception $exception) {

		 throw new TokenException('请重新登录', 401);

	 }

	 if ($de_token->voe < time() && $de_token->exp > time()) {

		 throw new TokenException('请换取新令牌', 402);

	 } else if ($de_token->voe < time()) {

		 throw new TokenException('请重新登录', 401);

	 }

	 if (Cache::tag('login')->get('token_' . $de_token->data->uid) != $token) {

		 throw new TokenException('用户信息错误，请重新登录', 401);

	 }

	 if ($de_token->data->is_ban == 1) {

		 throw new ValidateException('该账户已被封禁');

	 }

	 $request->auth = $de_token->data->uid;

		 return $next($request);

	 }

}