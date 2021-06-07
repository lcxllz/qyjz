<?php
// api通用错误码
namespace App\common\Err;
// use Exception;
// use think\exception\Handle;
// use think\exception\HttpException;
// use think\exception\ValidateException;
class ApiErrDesc 
{
   // code区间: 定义 0-10 
   const SUCCESS = [0,'Success'];
   const UNKNOWN_ERROR= [1,'未知错误'];
   const ERR_URL= [2,'访问的接口地址不存在'];
   const ERR_PARAMS= [100,'参数错误'];

   //  err_code:  1001-1100   用户登录相关错误
   const ERR_PASSWORD= [1001,'密码错误'];
   const ERR_TOKEN= [1002,'登录过期'];
   const ERR_USERNAME_NOT_EXIST= [1003,'用户不存在'];
}