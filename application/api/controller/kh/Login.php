<?php 
namespace app\api\controller\kh;
use app\common\help;
use app\common\service\OperationToken;
use think\Controller;
use think\Db;
use think\Request;

class Login extends Controller
{
     public function login(Request $request)
     {
        // 获取客户端传递的参数
        $phone = $request->param('phone');
        $password = $request->param('password');
         $info = Db::name('bdr_kh_user')->field('id,uuid,nick,gender,icon,im_accid,im_icon,is_ban')->where('del_time', '=', '0')->where(['mobile' => $phone, 'password' => $password])->findOrEmpty();
        
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


// namespace app\api\controller\bj;
// use app\common\Auth\JwtAuth;
// use think\Controller;
// // use app\admin\common\model\Khuser as KhuserModel;
// use think\Db;
// use think\Request;
// use app\http\Response\ResponseJson;
// use app\common\Err\ApiErrDesc;
// use app\Exceptions\ApiException;
// class Login extends Controller
// {
//     public function login(Request $request)
//     {
//         // 获取客户端传递的参数
//         $username = $request->param('username');
//         $password = $request->param('password');

//         // 去数据库或缓存中验证该用户  用户信息uid
//         $res = Db::table('bdr_kh_user')->where('username','test')->find();
        
//         if(!$res){
//             throw new ApiException(ApiErrDesc::ERR_USERNAME_NOT_EXIST);
//         }

//          // $res['password'] = password hash($password,PASSWORD DEFAULT);
//          if($res['password'] != MD5('111111')){
//             throw new ApiException(ApiErrDesc::ERR_PASSWORD);
//          }

//         $jwtAuth = JwtAuth::getInstance();    // 获取jwt句柄
//         $token = $jwtAuth->setUid($res['id'])->encode()->getToken();  // 封装token(获取token对象)
//         return $this->jsonSuccessData(['token' => $token]);   // token对象转为json格式数据
//     }

// }



