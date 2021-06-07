<?php 
namespace app\admin\controller;

use app\admin\common\controller\Base;
class Index extends Base
{
	public function index()
	{
		//检测是否登录
    	$this->isLogin();

		$this->view->assign('title','家政后台管理系统');
		
		//登录成功后默认跳转到用户管理界面
		return $this->view->fetch('index'); 
	}
}