<?php
namespace app\api\controller\kh;

use think\Controller;
use app\common\help;
use app\common\service\OperationToken;
use app\http\middleware\Auth;
use think\Db;
use think\Request;
use think\Facade\Cache;

class User extends Controller
{   
    public function index(Request $request)
    {

       $uid = $request->auth;
       dump($uid);die;
       // $uid = Cache::tag('login')->get('token_' . $de_token->data->uid)

	   // $OperTk = OperationToken::getInstance();    // 获取jwt句柄
	   // $uid = $OperTk->getUid();  
     //
     // 
     //   
       // $userinfo = Db::name('bdr_kh_user')->Field('mobile','password')->where('id',$uid)->find();
       // if($userinfo){
       // 	  return help::susJsonReturn($userinfo);
       // }else{
       // 	  return help::errJsonReturn('没有相关信息');
       // }
    }
}







// namespace app\api\controller\bj;
// use app\common\Auth\JwtAuth;
// use think\Controller;
// use app\admin\common\model\Khuser as KhuserModel;
// // use think\Request;
// use think\Db;
// use think\facade\Request;
// use app\http\Response\ResponseJson;
// use app\common\Err\ApiErrDesc;
// use app\Exceptions\ApiException;
// class User extends Controller
// {   
//     public function index(Request $request)
//     {
       
//         $jwtAuth = JwtAuth::getInstance();    // 获取jwt句柄
//         $uid = $jwtAuth->getUid();  
//         $res = Db::name('bdr_kh_user')->where('id',$uid)->find();
//         if(!$res){
//             throw new ApiException(ApiErrDesc::ERR_USERNAME_NOT_EXIST);
//         }
//         return $this->jsonSuccessData([
//         	'username' =>$res['username,'],
//         	'mobile' => $res['mobile'],
//         	'password' => $res['password'],
//         ]);
//     }

//     public function user_info_cache()
//     {       
//         $jwtAuth = JWTAuth::getInstance();    // 获取jwt句柄
//         $uid = $jwtAuth->getUid();  
//         // 判断一下 是否有缓存  redis 门面类
//         $redis = new \Redis();
//         $redis->connect('127.0.0.1',6379);
//         $cacheUserInfo = $redis->get('uid:'.$uid);
//         if(!$cacheUserInfo){
//         	// 缓存没有 查询数据库
// 	        $info = Db::name('bdr_kh_user')->where('id',$uid)->find();
// 	        if(!$info){
// 	            throw new ApiException(ApiErrDesc::ERR_USERNAME_NOT_EXIST);
// 	        }	
// 	        // 写入缓存
// 	        $redis->setex('uid:'.$uid,3600,json_encode($info->toArra()));
//         }else{
//         	$info = json_decode($cacheUserInfo);
//         }
//         return $this->jsonSuccessData([
//         	'username' =>$res['username,'],
//         	'mobile' => $res['mobile'],
//         	'password' => $res['password'],
//         ]);
//     }
// }


