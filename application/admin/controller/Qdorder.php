<?php 
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Qdorder as QdorderModel;
use app\admin\common\model\Sercate;
use app\admin\common\model\Serproject;
use think\facade\Request;
use think\facade\Config;

class Qdorder extends Base
{
    public function qdorderList()
	{
		//1. 检测是否登录
    	$this->isLogin();
		//2.获取所有项目
		   $qdList = QdorderModel::order('id','desc')->paginate(5);
    	if(!$qdList){
    		$this->error('暂时没有相关数据');
    	}else{
			$this->view->assign('title', '客户抢单列表');
			$this->view->assign('empty','<span style="red">没有任何数据</span>');
			$this->view->assign('qdList', $qdList);
			return $this->view->fetch('qdorderList');
    	}
	}

    public function qdorderadd()
	{
        $sercatelist = Sercate::all();
    	//1.设置编辑界面的模板变量
		$this->view->assign('title','添加抢单');
		$this->view->assign('sclist',$sercatelist);

		//2.渲染添加界面
		return $this->fetch('qdorderadd');
	}

    public function qdtwo()
	{
		$sid = request::param('sid');
		dump($sid);die;
        if(!$sid){
            $splist = Serproject::where('sid',$sid)->select();
		    $result['status'] = 200;
		    $result['data'] = $splist;
		}else{ //无值，返回状态码220
		    $result['status'] = 220;
        }
            echo json_encode($result); //返回JSON数据
	}

	public function doAdd()
	{

	}

}