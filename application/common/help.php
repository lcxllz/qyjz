<?php
namespace app\common;
class help
{
	 public static function susJsonReturn(array $data=[],string $msg='请求成功',int $code=1)
	 {
		 return json([
			 'msg'=> $msg,
			 'data'=> $data,
			 'code'=> $code
		 ]);
	 }

	 public static function errJsonReturn(string $msg = '请求失败', int $code = 0, array $data = [])
	 {
		 return json([
			 'msg'=> $msg,
			 'data'=> $data,
			 'code'=> $code
		 ]);
	 }
}