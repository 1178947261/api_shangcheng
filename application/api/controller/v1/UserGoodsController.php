<?php
namespace app\api\controller\v1;

use app\api\logic\UserGoodsLogic;
use think\Controller;
use think\Request;

class UserGoodsController extends Controller
{
    use Basetrait;

    //设置商家资料
    /**
     *  类别、标题、简介
     */
    public function addData(Request $request)
    {
        $id   = $this->user_id;
        $param    = $request->param();
        $service  = new UserGoodsLogic();
        $jsondata = $service->addData($id, $param);
        return $jsondata;
    }

    //获取销售额
    public function numberAmount()
    {

         $user_id = $this->user_id;
        $number_amount = new UserGoodsLogic();
        return $number_amount->numberAmount($user_id);
    }
    //获取店铺的关注量
    public function number_attention()
    {

        $user_id = $this->user_id;
        $number_amount = new UserGoodsLogic();
        return $number_amount->number_attention($user_id);

    }

}
