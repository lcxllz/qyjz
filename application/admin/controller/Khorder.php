<?php 
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Khorder as KhorderModel;
use think\facade\Request;
use think\facade\Config;

class Khorder extends Base
{
    public function khorderList()
	{
		//1. 检测是否登录
    	$this->isLogin();
        $sid = Request::param('sid');
		//2.获取所有项目
		if(isset($sid)){
		   $koList = KhorderModel::where('id',$sid)
		   ->order('id','desc')
		   ->paginate(5);
		}else{
		   $koList = KhorderModel::order('id','desc')->paginate(5);
		}
    	if(!$koList){
    		$this->error('暂时没有相关数据');
    	}else{
			$this->view->assign('title', '客户订单列表');
			$this->view->assign('empty','<span style="red">没有任何数据</span>');
			$this->view->assign('koList', $koList);
			return $this->view->fetch('khorderList');
    	}
	}

}