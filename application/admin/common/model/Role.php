<?php 
namespace app\admin\common\model;

use think\Model;

class Role extends Model 
{
	protected $pk = 'id';   //TP5.1不默认主键了.所以这里要手动 写上该数据表的主键
	protected $table = 'bdr_rbac_role';      //手动绑定表名.
	protected $up_time = 'up_time';      
}    