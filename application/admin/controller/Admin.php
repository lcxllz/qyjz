<?php 
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Admin as AdminModel;
use think\facade\Request;
use think\facade\Config;
use think\facade\Session;

class Admin extends Base 
{
	public function get()
	{
		//获取全部的配置项
		$config = Config::get();
	}

	private $password = '';  //临时存放用户密码

	//渲染登录界面
	public function login()
	{
		$this->view->assign('title','管理员登录');
		return $this->view->fetch('login'); 
	}

	//验证用户登录
	public function checkLogin()
	{
		$data = Request::param();
		
		$map[] = ['user','=',$data['username']];
		$map[] = ['pw','=',sha1($data['pass'])];
		$result = AdminModel::where($map)->find();
		if($result){
			Session::set('admin_id',$result['id']);
			Session::set('admin_name',$result['user']);
			Session::set('is_admin',$result['is_admin']);
			$this->success('登录成功','./index/index');
		}

		$this->error('登录失败');
	}

	//退出登录
	public function logout()
	{
		//1.清除全部session
		Session::clear();

		//2.退出登录并跳转到登录页面
		$this->success('退出成功','login');
	}


    public function adminAdd()
    {

		$this->view->assign('title','添加管理员');
		   return $this->view->fetch('adminadd');
    }

    public function doAdd()
    {

    		$all = Request::param();
    		$all['create_time'] = time();
	    	$insert = AdminModel::table('qy_admin')->insert($all);
	    	if(!$insert){
	    		$this->error('添加失败');
	    	}else{
	    		$this->success('添加成功');
	    	}
    }

	//用户列表:能执行到这里,肯定是超级管理员is_admin=1
	public function adminList()
	{
		//1.获取当前用户id与is_admin
		$data['user_id'] = Session::get('admin_id');
		$data['is_admin'] = Session::get('is_admin');

		//2.获取当前用户信息
		$adlist = AdminModel::where('id',$data['user_id'])->find();

		//3.如果是超级管理员就获取到全部用户
		if ($data['is_admin'] == 1){
			$adlist = AdminModel::select();
		}

		//4.设置必要的模板变量
		$this->view->assign('title', '后台用户列表');
		$this->view->assign('empty','<span style="red">没有任何数据</span>');
		$this->view->assign('adlist', $adlist);

		//5.渲染出用户列表
		return $this->view->fetch('adminlist');
	}

	//渲染编辑用户界面
	public function adminEdit()
	{
		//1.获取要更新的数据主键
		$adminId = Request::param('id');

		//2.根据主键查询到需要更新的用户全部信息
		$adminInfo = AdminModel::where('id',$adminId)->find();

		//3. 取出密码保存到私有属性中临时存储
		$this->password = $adminInfo['pw'];

		//4.设置编辑界面的模板变量
		$this->view->assign('title','编辑用户');
		$this->view->assign('adminInfo',$adminInfo);

		//5.渲染编辑界面
		return $this->fetch('adminedit');
	}

	//执行用户编辑操作
	public function doEdit()
	{
		//1.获取用户提交的更新信息
		$data = Request::param();

		$id = $data['id'];  //取出更新主键
		
        // 判断两次输入密码是否一致
		if ($data['pw'] !== $data['repass']) {

			$this->error('两次密码输入不一致，请重新输入');
			return false;
		} else {
			unset($data['repass']); 
		}

		//2.将用户密码加密后再写回
		if ($data['pw'] == $this->password) {
			unset($data['pw']); 
		} else {
			$data['pw'] = sha1($data['pw']);
		}

		//3.删除主键字段,封装出要更新的字段数组
		unset($data['id']);

		//4.执行更新操作
		if(AdminModel::where('id',$id)->data($data)->update()){
			return $this->success('更新成功','adminList');
		}

		//3. 更新失败提示
		$this->error('没有更新或更新失败');
	}


	//执行用户的删除操作
	public function doDelete()
	{
		//1.获取要删除的数据主键
		$id = Request::param('id');

		//2.执行删除操作
		if(AdminModel::where('id',$id)->delete()){
			return $this->success('删除成功','adminList');
		}

		//3. 删除失败提示
		$this->error('删除失败');

	}

}

















