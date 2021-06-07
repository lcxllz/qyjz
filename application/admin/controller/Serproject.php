<?php 
namespace app\admin\Controller;
use think\Controller;
//use app\admin\common\controller\Base;
use app\admin\common\model\Serproject as SerprojectModel;
use app\admin\common\model\Sercate;
use think\facade\Request;
use think\facade\Config;
use think\validate;

class Serproject extends Controller
{
    public function serprojectList()
	{
		//1. 检测是否登录
    	//$this->isLogin();
        $sid = Request::param('sid');
		//2.获取所有项目
		if(isset($sid)){
		   $speList = SerprojectModel::where('id',$sid)
		   ->order('id','desc')
		   ->paginate(5);
		}else{
		   $speList = SerprojectModel::order('id','desc')->paginate(5);
		}
    	if(!$speList){
    		$this->error('暂时没有相关数据');
    	}else{
			$this->view->assign('title', '服务项目列表');
			$this->view->assign('empty','<span style="red">没有任何数据</span>');
			$this->view->assign('speList', $speList);
			return $this->view->fetch('serprojectlist');
    	}
	}


	//渲染编辑项目界面
	public function serprojectEdit()
	{
		//1.获取要编辑的服务项目主键
        $id = Request::param('id');
        //$sid = Request::param('sid');

		//2.根据主键查询到需要更新的全部信息
		$proInfo = SerprojectModel::where('id',$id)->find();
        $sid = $proInfo['sid'];

		//3.获取到所有的分类信息
		$SercateList = Sercate::all();

		//4.设置编辑界面的模板变量
		$this->view->assign('title','编辑服务项目');
		$this->view->assign('proInfo',$proInfo);
		$this->view->assign('serty',$SercateList);

		//5.渲染编辑界面
		return $this->fetch('serprojectEdit');
	}

    //渲染添加界面
    public function serprojectAdd()
    {
        $sercatelist = Sercate::all();
        //1.设置编辑界面的模板变量
        $this->view->assign('title','添加服务项目');
        $this->view->assign('sclist',$sercatelist);

        //2.渲染添加界面
        return $this->fetch('serprojectadd');
    }

	//处理服务项目添加
	public function doAdd()
     {   
        //1.获取表单提交的数据
        $data = Request::param();

        //2.获取上传的标题图片信息
        $file = Request::file('sp'); //获取file对象   $file当前要上传的文件的信息

        //3.文件信息验证与上传到服务器指定目录 $info是文件上传到服务器后方的信息.
        $info = $file -> validate([
            'size'=>5000000000,  //文件大小
            'ext'=>'jpeg,jpg,png,gif'  //文件扩展名
        ]) -> move('uploads/');  //移动到public/uploads目录下面

        //4.判断上传文件的信息
        if ($info) {
            $data['sp'] = $info->getSaveName();
        } else {
            $this->error($file->getError());
        }

        //5.将数据写到表中
        if(SerprojectModel::create($data)){ //条件中$data['id']中
            $this->success('操作成功','serprojectlist');
        } else {
            $this->error('操作失败');
        }
     }

     //执行文章删除操作
     public function doDelete()
     {
     	//1. 获取要删除产品的ID
     	$id = Request::param('id');

     	//2.执行删除操作并判断是否成功
     	if(SerprojectModel::destroy($id)){
     		$this->success('删除成功');
     	} 

     	//3.如果删除失败
     	    $this->error('删除失败');
     }

}