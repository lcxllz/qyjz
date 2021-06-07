<?php 
namespace app\admin\common\model;

use think\Model;

class Admin extends Model 
{
	protected $pk = 'id';   //TP5.1不默认主键了.所以这里要手动 写上该数据表的主键
	protected $table = 'bdr_admin';      //手动绑定表名.
	protected $is_admin = 'is_admin';      
}    