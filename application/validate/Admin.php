<?php 
namespace app\validate;

use think\Validate;

class Admin extends Validate 
{
	//验证规则[属性]
	protected $rule = [
		'name|姓名'=> [
			'require',
			'unique',
			'max'=>20,
			'alphaDash',//只能是字母数字下划线或破折号			
		],
		'email|邮箱'=>[
			'require',
			'email',
		],
		'password|密码'=>[
			'require',
			'min'=>3,
			'max'=>10,
			'alphaNum',//密码只能是字母或数字
		],
		'mobile|手机'=>[
			'require',
			'mobile',		
	]
];

	//提示信息[属性]
	protected $message = [
		
	];
}