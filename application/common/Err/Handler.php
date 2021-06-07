<?php
namespace App\common\Err;
use app\common\Err\ApierrDesc;
class Handler 
{
  public function render($request, Exception $exception)
  {
     use ResponseJson;
   // return parent::render($request,$exception);
   if($exception instanceof ApiException){
      $code = $exception->getCode();
      $message = $exception->getMessage();
   }else{
      $code = $exception->getCode();
      if(!$code || $code<0){
        $code = ApiErrDesc::UNKNOWN_ERROR[0];
      }
    $message = $exception->getMessage()? ApiErrDesc::UNKNOWN_ERROR[1];
   }
    return $this->jsonData($code,$message);
  }
}