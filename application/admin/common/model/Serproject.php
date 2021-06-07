<?php 
namespace app\admin\common\model;

use think\Model;

class Serproject extends Model 
{
	protected $pk = 'id';   //TP5.1不默认主键了.所以这里要手动 写上该数据表的主键
	protected $table = 'bdr_serproject';      //手动绑定表名.
// 定义与服务项目的一对多关联
    public function sercate()
    {
        return $this->belongsTo('sercate');
    }
}    