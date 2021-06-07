<?php
namespace app\facade;
use think\Facade;
class Sercate extends Facade
{
  protected static function getFacadeClass()
  {
  	return 'app\validate\Sercate';
  }
}