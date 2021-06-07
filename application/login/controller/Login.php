<?php
namespace app\api\controller\bj;
use app\common\help;
use app\common\service\OperationToken;
use think\Controller;
use think\Db;
use think\Request;

class Login extends Controller
{
	 public function login(Request $request)
	 {
		 $info = Db::name('bdr_kh_user')->field('id,uuid,nick,gender,icon,im_accid,im_icon,is_ban')->where('del_time', '=', '0')->where(['mobile' => $request->param('phone'), 'password' => md5($request->param('password'))])->findOrEmpty();

		 if ($info == null || empty($info)) {
			 return help::errJsonReturn('账号或密码错误');
		 }

		 $token = OperationToken::createToken($info['id'], $info['uuid'], $info['is_ban']);
		 return json([
			 'type' => 'Bearer ',
			 'access_token'=>$token['token'],
			 'exp_time'=>$token['exp'],
			 'voe_time'=>$token['voe'],
			 'iat_time'=>time()
		 ]);
	 }
}