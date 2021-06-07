<?php
namespace app\facade;
use think\Facade;
class Area extends Facade
{
  protected static function getFacadeClass()
  {
  	return 'app\validate\Area';
  }
}