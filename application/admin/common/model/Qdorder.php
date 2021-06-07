<?php 
namespace app\admin\common\model;

use think\Model;

class Qdorder extends Model 
{
	protected $pk = 'id';   //TP5.1不默认主键了.所以这里要手动 写上该数据表的主键
	protected $table = 'bdr_qdorder';      //手动绑定表名.


    public function getQdtype($value)
    {
        $qdtpye = [
           0 => '新人专享',
           1 => '整点秒杀',
           2 => '限时秒杀'
        ];
        return $qdtpye[$value];
    }
}    