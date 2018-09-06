<?php
namespace app\api\controller\v1;

use think\Controller;
use think\Request;

class IndexController extends  Controller
{
    use Basetrait;
    public function hello(Request $request)
    {
       $data=[
           'name'=>'aname'
       ];
       $msg= $this->buildParam($data);
       return self::showReturnCode(200,$msg);
    }
}
