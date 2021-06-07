<?php 
namespace app\admin\common\model;

use think\Model;

class Khuser extends Model 
{
	protected $pk = 'id';   //TP5.1不默认主键了.所以这里要手动 写上该数据表的主键
	protected $table = 'bdr_kh_user';      //手动绑定表名.
}    