<?php
namespace app\common\controller;
 
class Base extends Controller
{
    protected function create($data,string $msg='',int $code=200,string $type='json'):Response
       {
		//返回api结果
		$result = [
		          'code'=>$code,    //状态码
		          'msg' => $msg,    //自定义消息
		          'data' => $data   //数据返回
		];
		return  Response::create($result,$type);  //将数据返回成指定格式，默认json
      }
}
