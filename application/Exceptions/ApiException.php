<?php
namespace app\Exceptions;
use think\Throwable;
use think\Exception;
class ApiException extends \RuntimeException
{

    public function __construct(array $apiErrorConst,Throwable $previous = null)
    {
      $code = $apiErrorConst[0];
      $message = $apiErrorConst[1];
      parent::__construct($message,$code,$previous);
	}
}