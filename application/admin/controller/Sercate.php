<?php 
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Sercate as SercateModel;
use think\facade\Request;
use think\facade\Config;


class Sercate extends Base
{
    // 渲染服务类型列表界面
    public function sercateList()
	{
		//1. 检测是否登录
    	$this->isLogin();

		//2.获取所有分类
		$spList = SercateModel::select();
    	if(!$spList){
    		$this->error('暂时没有相关数据');
    	}else{
			$this->view->assign('title', '服务类型列表');
			$this->view->assign('empty','<span style="red">没有任何数据</span>');
			$this->view->assign('spList', $spList);
			return $this->view->fetch('sercateList');
    	}
	}

	//渲染添加界面
	public function sercateAdd()
	{
    	//1.设置编辑界面的模板变量
		$this->view->assign('title','添加分类');

		//2.渲染添加界面
		return $this->fetch('sercateadd');
	}
	
    // 添加服务类型
    public function doAdd()
	{
		//1.获取要添加的数据
		$data = Request::param('name');
		$res = SercateModel::where('name',$data)->find();
		if($res){
		    $this->error('名字已重复,请重新输入');
		}else{
			$res = SercateModel::create(['name'=>$data]);
			if($res){
		    	//2.执行添加操作并判断是否成功
				$this->success('添加成功','sercateList');
			}else{
			   //3:失败
			   $this->error('添加失败');
			}
		}
    }


	//渲染编辑界面
    public function sercateEdit()
    {
		$id = Request::param('id');
		$spInfo = SercateModel::where('id',$id)->find();
		$this->view->assign('title','编辑分类');
		$this->view->assign('spInfo', $spInfo);
		return $this->view->fetch('sercateedit');
    }
    public function doEdit()
	{
		//1.获取用户提交的更新信息
		$data = Request::param();

		$id = $data['id'];  //取出更新主键

		//2.删除主键字段,封装出要更新的字段数组
		unset($data['id']);

		//3.执行更新操作
		if(SercateModel::where('id',$id)->data($data)->update()){
			return $this->success('更新成功','sercateList');
		}

		//4. 更新失败提示
		$this->error('没有更新或更新失败');
	}
	//执行服务分类删除操作
	public function doDelete()
	{
		//1.获取要删除的数据主键
		$id = Request::param('id');

		//2.执行删除操作
		if(SercateModel::where('id',$id)->delete()){
			return $this->success('删除成功','sercateList');
		}
		//3. 删除失败提示
		$this->error('删除失败');

	}
}