<?php 
namespace app\admin\common\controller;
use think\Controller;
use think\facade\Request;
use think\facade\Session;

//后台公共控制器
class Base extends Controller 
{
	// 初始化
    protected function initialize()
    {
        
    }

    /**
     * 检测用启是否登录
     * 调用位置:
     * 1.后台首页的admin/index/index()
     */
    protected function isLogin()
    {
        if (!Session::has('admin_id')) {
            $this->error('请先登录','admin/admin/login');
        }
    }

   protected function create($data,string $msg='',int $code=200,string $type='json'):Response
   {
    //返回api结果
    $result = [
              'code'=>$code,    //状态码
              'msg' => $msg,    //自定义消息
              'data' => $data   //数据返回
    ];
    return  Response::create($result,$type);  //将数据返回成指定格式，默认json
  }
}